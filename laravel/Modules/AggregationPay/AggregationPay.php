<?php

namespace Modules\AggregationPay;

use Modules\AggregationPay\Entities\PaymentRecord;
use Modules\AggregationPay\Services\WechatService;

class AggregationPay
{
    public function payment(string $channel, $order, float $amount, string $remark = '', string $out_trade_no = null,string $return_url = '')
    {
        $able_id = $order->id;
        $able_type = get_class($order);

        $channels = array_keys(trans('AggregationPay::payment.channels'));
        if (!in_array($channel, $channels)) {
            return abort(403, '无效支付渠道，仅支持：' . implode(',', $channels));
        }

        $createData = [
            'channel' => $channel,
            'able_id' => $able_id,
            'able_type' => $able_type,
            'amount' => $amount,
            'remark' => $remark
        ];
        if($out_trade_no){
            $createData['out_trade_no'] = $out_trade_no;
        }

        $record = PaymentRecord::firstOrCreate($createData);

        $notify_url = action(config('aggregation_pay.notify_action'), $channel);

        return $record->initiatePayment($notify_url, $return_url);
    }

    public function refund(PaymentRecord $paymentRecord, float $amount, string $remark = '', string $refund_no = null)
    {
        $order = $paymentRecord->able;

        $able_id = $order->getIdAttribute();
        $able_type = get_class($order);

        $createData = [
            'able_id' => $able_id,
            'able_type' => $able_type,
            'amount' => $amount,
            'remark' => $remark
        ];
        if($refund_no){
            $createData['refund_no'] = $refund_no;
        }

        return $paymentRecord->refundRecords()->firstOrCreate($createData);
    }

    /**
     * @param $channel
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function payHook($channel)
    {
        if (strstr($channel, 'alipay_')) {
            $payment_record = PaymentRecord::where('out_trade_no', request('out_trade_no'))
                ->first();

            if ($payment_record && $payment_record->checkStatus()) {
                return response('success');
            }
            return response('fail');
        } else if (strstr($channel, 'wechat_')) {
            return WechatService::getInstance()->payment()->handlePaidNotify(function ($message, $fail) {
                $payment_record = PaymentRecord::where('out_trade_no', $message['out_trade_no'])
                    ->first();

                if (!$payment_record) { // 如果订单不存在
                    $fail('Order not exist.'); // 告诉微信，我已经处理完了，订单没找到，别再通知我了
                }

                if ($payment_record->status == 'paid') {
                    return true;
                }

                if ($message['result_code'] === 'SUCCESS') {
                    $payment_record->checkStatus();
                }

                return true;
            });
        } else {
            abort(404, '找不到此订单');
        }

        return $channel;
    }
}
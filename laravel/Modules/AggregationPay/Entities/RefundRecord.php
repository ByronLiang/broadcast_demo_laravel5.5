<?php

namespace Modules\AggregationPay\Entities;

use Modules\AggregationPay\Services\AlipayService;
use Modules\AggregationPay\Services\WechatService;
use Modules\AggregationPay\Events\RefundSuccess;

class RefundRecord extends \App\Models\Model
{
    const STATUS_REFUNDING = 'refunding'; // 退款中
    const STATUS_REFUNDED = 'refunded'; // 已退款
    const STATUS_FAILURE = 'failure'; // 失败

    protected static function boot()
    {
        parent::boot();
        static::created(function (self $model) {
            $model->initiateRefund();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo|Model
     */
    public function able()
    {
        return $this->morphTo();
    }

    public function paymentRecord()
    {
        return $this->belongsTo(PaymentRecord::class);
    }

    public function statusToRefunded()
    {
        if ($this->status == self::STATUS_REFUNDED) return $this;
        $this->status = self::STATUS_REFUNDED;
        $this->save();

        event(new RefundSuccess($this));

        return $this;
    }

    /**
     * 发起退款操作
     * @return $this|RefundRecord
     * @throws \Exception
     */
    public function initiateRefund()
    {
        if ($this->status == self::STATUS_REFUNDED) return $this;
        if($this->paymentRecord->amount < $this->amount){
            $this->amount = $this->paymentRecord->amount;
        }
        if (!$this->refund_no) {
            $this->refund_no = date('YmdHis') . $this->id;
            $this->save();
        }
        $channel = $this->paymentRecord->channel;

        if($this->amount < 0.01){
            return $this->statusToRefunded();
        }

        switch ($channel) {
            case 'alipay_web':
                $result = AlipayService::getInstance('web')
                    ->tradeRefund(
                        $this->paymentRecord->out_trade_no,
                        $this->amount,
                        $this->refund_no
                    );
                if ($result->code == 10000) {
                    $this->statusToRefunded();
                } elseif ($result->code != 40004) {
                    abort(422, json_encode($result));
                }
                break;
            case 'wechat_public':
            case 'wechat_qr':
            case 'wechat_wap':
                $result = WechatService::getInstance('public')
                    ->refund(
                        $this->paymentRecord->out_trade_no,
                        $this->refund_no,
                        $this->paymentRecord->amount,
                        $this->amount
                    );
                if ($result['result_code'] == 'FAIL') {
                    // if(in_array($result->err_code, ['ERROR', 'USER_ACCOUNT_ABNORMAL'])){
                    //无法退款，取消操作
                    // }
                    if ($result['err_code'] == 'NOTENOUGH') {
                        throw new \Exception('微信商户平台可用余额不足，请充值后重试');
                    }
                    \Log::error('退款失败:' . $result['err_code_des']);
                    throw new \Exception('微信退款出错，请联系处理');
                } else if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
                    $this->statusToRefunded();
                }
                break;
            case 'test':
                return $this->statusToRefunded();
                break;
        }


        return $this;
    }
}

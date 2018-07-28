<?php

namespace Modules\AggregationPay\Entities;

use Modules\AggregationPay\Services\AlipayService;
use Modules\AggregationPay\Services\WechatService;
use Modules\AggregationPay\Events\PaymentSuccess;

class PaymentRecord extends \App\Models\Model
{
    const STATUS_PAYING = 'paying';
    const STATUS_PAID = 'paid';

    protected $hidden = [
        'able_id',
        'able_type',
    ];

    protected $attributes = [
        'status' => self::STATUS_PAYING,
    ];

    protected $casts = [
        'amount' => 'float'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo|Model
     */
    public function able()
    {
        return $this->morphTo();
    }

    /**
     * @param $notify_url
     * @param string $return_url
     * @return PaymentRecord|mixed|null|string
     * @throws \Exception
     */
    public function initiatePayment($notify_url, $return_url = '')
    {
        if ($this->status != self::STATUS_PAYING) {
            throw new \Exception('已支付');
        }
        if (!$this->out_trade_no) {
            $this->out_trade_no = date('YmdHis') . $this->id;
            $this->save();
        }

        if (!$this->amount || $this->amount < 0.01) {
            return $this->statusToPaid();
        }

        if (!$return_url) $return_url = url('order/all');
        if (!strpos($return_url, '://')) $return_url = url($return_url);

        if (strstr($this->channel, 'alipay_')) {
            $trade_types = [
                'alipay_app' => 'tradeAppPay',
                'alipay_web' => 'tradePagePay',
                'alipay_wap' => 'tradeWapPay',
            ];
            return AlipayService::getInstance()
                ->setNotifyUrl($notify_url)
                ->{$trade_types[$this->channel]}(
                    $this->out_trade_no
                    , $this->out_trade_no
                    , $this->amount
                    , $return_url,
                    $this->remark
                );
        } else if (strstr($this->channel, 'wechat_')) {
            $trade_types = [
                'wechat_wap' => 'MWEB',
                'wechat_qr' => 'NATIVE',
                'wechat_public' => 'JSAPI',
                'wechat_applet' => 'JSAPI',
                'wechat_app' => 'APP',
            ];
            return WechatService::getInstance()
                ->setNotifyUrl($notify_url)
                ->paymentConfig(
                    $this->out_trade_no,
                    $this->amount,
                    $this->out_trade_no,
                    $this->remark,
                    $trade_types[$this->channel]
                );
        } else {
            return $this->statusToPaid();
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function checkStatus()
    {
        if ($this->status != self::STATUS_PAYING) {
            return true;
        }
        switch ($this->channel) {
            case 'alipay_web':
            case 'alipay_wap':
                $res = AlipayService::getInstance()
                    ->tradeQuery($this->out_trade_no);
                if ($res->code == 10000) {
                    $this->statusToPaid();
                    return true;
                } elseif ($res->code != 40004) {
                    abort(422, json_encode($res));
                }
                break;
            case 'wechat_wap':
            case 'wechat_qr':
            case 'wechat_public':
            case 'wechat_applet':
            case 'wechat_app':
                $res = WechatService::getInstance()->payment()
                    ->order
                    ->queryByOutTradeNumber($this->out_trade_no);
                if ($res['return_code'] == 'SUCCESS' && $res['trade_state'] == 'SUCCESS') {
                    $this->statusToPaid();
                    return true;
                } else {
                    abort(422, json_encode($res));
                }
                break;
        }
        \Log::error('无效支付状态检查', $this->toArray());
        return false;
    }

    public function statusToPaid()
    {
        if ($this->status == self::STATUS_PAID) return $this;
        $this->status = self::STATUS_PAID;
        $this->save();

        event(new PaymentSuccess($this));

        return $this;
    }

    public function refundRecords()
    {
        return $this->hasMany(RefundRecord::class);
    }
}

<?php

namespace Modules\AggregationPay\Events;

use Modules\AggregationPay\Entities\PaymentRecord;
use Illuminate\Queue\SerializesModels;

class PaymentSuccess
{
    use SerializesModels;

    public $record;

    /**
     * PaymentSuccess constructor.
     * @param PaymentRecord $record
     */
    public function __construct(PaymentRecord $record)
    {
        $this->record = $record;
    }
}
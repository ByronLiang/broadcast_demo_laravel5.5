<?php

namespace Modules\AggregationPay\Events;

use Modules\AggregationPay\Entities\RefundRecord;
use Illuminate\Queue\SerializesModels;

class RefundSuccess
{
    use SerializesModels;

    public $record;

    /**
     * RefundSuccess constructor.
     * @param RefundRecord $record
     */
    public function __construct(RefundRecord $record)
    {
        $this->record = $record;
    }
}
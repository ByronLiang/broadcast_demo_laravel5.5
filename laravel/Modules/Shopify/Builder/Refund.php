<?php

namespace Modules\Shopify\Builder;

class Refund
{
    public static function initArray($quantity, $currency, $item_id)
    {
        return array(
            "refund" => [
                "currency" => $currency,
                "shipping" => [
                    "full_refund" => true,
                ],
                "refund_line_items" => [
                    [
                        "line_item_id" => $item_id,
                        "quantity" => $quantity,
                        "restock_type" => "no_restock",
                    ]
                ],
            ]
        );
    }
}
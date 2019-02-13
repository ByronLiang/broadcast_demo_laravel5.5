<?php

namespace Modules\Shopify\Builder;

use PHPShopify\ShopifyResource;

class Checkout extends ShopifyResource
{
    protected $resourceKey = 'checkout';

    public function initArray($id, $quantity)
    {
        return array(
            'line_items' => [
                [
                    'variant_id' => $id,
                    'quantity' => $quantity,
                ],
            ],
        );
    }

    public function createCheckout($amount)
    {
        $product = new Product();
        $products = $product->get();
        $item = array_first(array_first($products)['variants']);
        if (!isset($item['id'])) {
            abort(400, '未建立商品SKU');
        }
        $amount = $amount ?? 0;
        $checkout_data = $this->initArray($item['id'], round($amount / $item['price']));

        return $this->post($checkout_data);
    }
}
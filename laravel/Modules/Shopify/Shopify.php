<?php

declare(strict_types=1);

namespace Modules\Shopify;

class Shopify
{
    public static function shopifyOauth()
    {
        \Route::get('shopify/oauth', '\Modules\Shopify\Http\Controllers\ShopifyAuthController@getOauth')
            ->name('ShopifyOauth');
    }
}
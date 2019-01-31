<?php

namespace App\Http\Controllers\Callback;

class ShopifyController extends Controller
{
    public function index()
    {
        \Log::info('header: '. request()->header('X-Shopify-Topic'));
        \Log::info('body');
        \Log::info('json');
        \Log::info(json_encode(request()->all()));

        return response('success');
    }
}

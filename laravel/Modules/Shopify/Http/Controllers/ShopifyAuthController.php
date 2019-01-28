<?php

namespace Modules\Shopify\Http\Controllers;

use Illuminate\Routing\Controller;

class ShopifyAuthController extends Controller
{
    public function getOauth()
    {
        return \Response::success();
    }
}

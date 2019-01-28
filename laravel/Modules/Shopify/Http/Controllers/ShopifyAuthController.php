<?php

namespace Modules\Shopify\Http\Controllers;

use Illuminate\Routing\Controller;
use PHPShopify\ShopifySDK;
use PHPShopify\AuthHelper;

class ShopifyAuthController extends Controller
{
    public function getOauth()
    {
        $config = config('services.shopify');
        if(!empty($config)) {
            ShopifySDK::config($config);
        } else {
            abort(400, '未配置shopify信息');
            \Log::info('未配置shopify信息');
        }
        $scopes = 'write_checkouts,read_checkouts,read_products,write_orders,read_orders';
        if(isset($_GET['code'])) {
            // 获取授权token
            $accessToken = AuthHelper::getAccessToken();
            \Log::info($config['ShopUrl']. ' access_token:' . $accessToken);
        } else {
            return redirect(AuthHelper::createAuthRequest($scopes, request()->url(), null, null, true));
        }

        return \Response::success();
    }
}

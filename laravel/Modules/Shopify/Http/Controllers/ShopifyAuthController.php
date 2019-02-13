<?php

namespace Modules\Shopify\Http\Controllers;

use Illuminate\Routing\Controller;
use PHPShopify\ShopifySDK;
use PHPShopify\AuthHelper;
use Modules\Shopify\Builder\Oauth;

class ShopifyAuthController extends Controller
{
    public function getOauth(Oauth $oauth)
    {
        return $oauth->getOauth();

        // $config = config('services.shopify');
        // if(!empty($config)) {
        //     ShopifySDK::config($config);
        // } else {
        //     abort(400, '未配置shopify信息');
        //     \Log::info('未配置shopify信息');
        // }
        // // 权限设置
        // $scopes = 'write_checkouts,read_checkouts,read_products,write_orders,read_orders';
        // if(isset($_GET['code'])) {
        //     // 获取授权token
        //     $accessToken = AuthHelper::getAccessToken();
        //     // 永久缓存存储授权token值
        //     \Cache::forever($config['ShopUrl'].':access_token', $accessToken);
        //     // 授权成功, 重定向到shopify的后台管理页面
        //     return redirect(ShopifySDK::$config['AdminUrl']);
        // } else {
        //     return redirect(AuthHelper::createAuthRequest($scopes, request()->url(), null, null, true));
        // }

        // return \Response::success();
    }
}

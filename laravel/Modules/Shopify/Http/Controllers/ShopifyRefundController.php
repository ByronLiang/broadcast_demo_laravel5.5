<?php

namespace Modules\Shopify\Http\Controllers;

use PHPShopify\ShopifySDK;
use Modules\Shopify\Builder\Refund;
use Illuminate\Routing\Controller;

class ShopifyRefundController extends Controller
{
    protected $shopify;
    
    public function __construct()
    {
        $config = config('services.shopify');
        if (isset($config['ShopUrl'])) {
            $config['AccessToken'] = \Cache::get($config['ShopUrl']. ':access_token');
        }
        $this->shopify = new ShopifySDK($config);
    }

    public function index($id)
    {
        $data = $this->shopify->Order($id)->get();
        dd($data);
    }

    public function create($id)
    {
        $data = $this->shopify->Order($id)->get();
        if (isset($data['line_items'])) {
            $item = array_first($data['line_items']);
            $amount = request('amount') ?? 0;
            $quantity = round($amount / $item['price']);
            // 返回以refund为key的数组数据结构
            $refund_data = Refund::initArray($quantity, $data['currency'], $item['id']);
            $res = $this->shopify
                ->Order($id)
                ->Refund
                ->calculate($refund_data);
            dd($res);
        } else {
            abort(400, '无法获取单据');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('shopify::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('shopify::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}

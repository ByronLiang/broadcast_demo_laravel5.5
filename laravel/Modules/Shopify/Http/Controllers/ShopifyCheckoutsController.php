<?php

namespace Modules\Shopify\Http\Controllers;

use PHPShopify\ShopifySDK;
use PHPShopify\Product;
use Modules\Shopify\Builder\Checkout;
use Illuminate\Routing\Controller;

class ShopifyCheckoutsController extends Controller
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

    public function index()
    {
        return view('shopify::index');
    }

    public function create()
    {
        $products = $this->shopify->Product->get();
        $item = array_first(array_first($products)['variants']);
        $checkout = array (
            "line_items" => [
              [
                  "variant_id" => $item['id'],
                  "quantity" => 5
              ]
            ]
        );
        $checkout = new Checkout();
        $data = $checkout->post($checkout);
        dd($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    public function show($token)
    {
        $checkout = new Checkout($token);
        $data = $checkout->get();
        dd($data);
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

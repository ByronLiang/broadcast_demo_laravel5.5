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

    // 退款核算与完成退款操作
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
            if (isset($res['transactions'])) {
                $transaction = array_first($res['transactions']);
                $create_refund = $refund_data['refund'];
                $create_refund['notify'] = false;
                $create_refund['note'] = '';
                $create_refund['transactions'] = array(
                    [
                        "parent_id" => $transaction['parent_id'],
                        "amount" => $transaction['amount'],
                        "kind" => "refund",
                        "gateway" => $transaction['gateway']
                    ]
                );
                $refund_res = $this->shopify
                    ->Order($id)
                    ->Refund
                    ->post($create_refund);
                dd($refund_res);
            } else {
                abort(400, '无法生成退款交易信息');
            }
        } else {
            abort(400, '无法获取单据');
        }
    }

    // 经过退款核算, 独立进行退款最后请求
    public function store()
    {
        $id = '713103409186';
        $create_refund = array (
            'currency' => 'JPY',
            'shipping' => 
            array (
              'full_refund' => true,
            ),
            'refund_line_items' => 
            array (
              0 => 
              array (
                'line_item_id' => 1694274256930,
                'quantity' => 5.0,
                'restock_type' => 'no_restock',
              ),
            ),
            'notify' => false,
            'note' => 'avx',
            'transactions' => 
            array (
              0 => 
              array (
                'parent_id' => 918500540450,
                'amount' => '500',
                'kind' => 'refund',
                'gateway' => 'shopify_payments',
              ),
            ),
        );
        $res = $this->shopify->Order($id)->Refund->post($create_refund);
        dd($res);
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

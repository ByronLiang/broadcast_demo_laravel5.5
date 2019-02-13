<?php

namespace Modules\Shopify\Builder;

use PHPShopify\Order;

class Refund
{
    private $id;

    protected $order;

    public function __construct($id)
    {
        $this->id = $id;
        $this->order = (new Order($id));
    }

    public function fetchOrder($id)
    {
        return $this->order->get();
    }

    public function initCalculate($id, $amount)
    {
        $data = $this->fetchOrder($id);
        if (isset($data['line_items'])) {
            $item = array_first($data['line_items']);
            $quantity = round($amount / $item['price']);
            // 返回以refund为key的数组数据结构
            return $this->initCalculateArray($quantity, $data['currency'], $item['id']);
        } else {
            return false;
        }
    }

    // 对退款进行核算操作
    public function calculate($id, array $refund_data)
    {
        return $this->order->Refund->calculate($refund_data);
    }

    public function createRefund($amount)
    {
        $refund_data = $this->initCalculate($this->id, $amount);
        if (!is_array($refund_data)) {
            return false;
        }
        $res = $this->calculate($this->id, $refund_data);
        if (!isset($res['transactions'])) {
            return false;
        }
        $create_refund = $this->initCreateRefundArray(
            $refund_data,
            array_first($res['transactions'])
        );
        // 发起最终的退款请求
        $refund_res = $this->order
            ->Refund
            ->post($create_refund);
        if (!isset($refund_res['transactions'])) {
            return false;
        }
        $refund_transactions = array_first($refund_res['transactions']);
        if ('success' == $refund_transactions['status'] &&
            'refund' == $refund_transactions['kind']) {
            return true;
        } else {
            return false;
        }
    }

    // 初始化计算退款数目数组
    public function initCalculateArray($quantity, $currency, $item_id)
    {
        return array(
            'refund' => [
                'currency' => $currency,
                'shipping' => [
                    'full_refund' => true,
                ],
                'refund_line_items' => [
                    [
                        'line_item_id' => $item_id,
                        'quantity' => $quantity,
                        'restock_type' => 'no_restock',
                    ],
                ],
            ],
        );
    }

    public function initCreateRefundArray($refund_data, $transaction)
    {
        $create_refund = $refund_data['refund'];
        $create_refund['notify'] = false;
        $create_refund['note'] = '';
        $create_refund['transactions'] = array(
            [
                'parent_id' => $transaction['parent_id'],
                'amount' => $transaction['amount'],
                'kind' => 'refund',
                'gateway' => $transaction['gateway'],
            ],
        );

        return $create_refund;
    }
}
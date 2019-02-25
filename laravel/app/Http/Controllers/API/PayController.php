<?php

namespace App\Http\Controllers\API;

use App\Services\PayssionService;
use App\Models\Order;
use Modules\AggregationPay\AggregationPay;

class PayController extends Controller
{
	/**
     * @OAS\Get(path="/pay",tags={"Pay"},
        summary="Just some data list",description="",
     * @OAS\Parameter(name="id",in="query",description="分类ID",required=false,
     * @OAS\Schema(type="integer",format="int10")),
     * @OAS\Parameter(name="name",in="query",description="分类名称",required=false,
     * @OAS\Schema(type="string")),
     * @OAS\Response(response=200,description="successful operation"),
     *   
     * )
     *
	**/
    public function pay()
    {
    	$payssion = new PayssionService(
    		config('services.payssion.api_key'), 
    		config('services.payssion.api_secret'),
    		false
    	);
    	$response = null;
		try {
			$response = $payssion->create(array(
					'amount' => 0.01,
					'currency' => 'CNY',
					'pm_id' => 'dotpay_pl',
					'description' => 'Test Pay',
					//your order id
					'order_id' => 'fds123',
					//optional, the return url after payments (for both of paid and non-paid)
					'return_url' => action('Callback\PayController@returnCallback'),
			));
		} catch (Exception $e) {
			//handle exception
			echo "Exception: " . $e->getMessage();
		}
		// \Log::info('pay: '. $payssion);
		// \Log::info('res: '. $response);
		if ($payssion->isSuccess()) {
			//handle success
			$todo = $response['todo'];
			if ($todo) {
				$todo_list = explode('|', $todo);
				if (in_array("redirect", $todo_list)) {
				    //redirect the users to the redirect url or send the url by email
				    $paylink = $response['redirect_url'];
				    // \Log::info('psy_link: '. $paylink);
			    }

			    return \Response::success($response);
			} else {
			//just in case, should not be here
			}
		} else {
			//handle failed
			return \Response::error('error');
		}
    }

    public function alipay(AggregationPay $checkout)
    {
        $order = Order::create([
        	'amount' => 100,
        ]);

        $aa = $checkout->payment(
        	'alipay_web', $order, 100, 'test', strtotime('now'), 'https://www.baidu.com'
        );

        return redirect($aa);
    }
}

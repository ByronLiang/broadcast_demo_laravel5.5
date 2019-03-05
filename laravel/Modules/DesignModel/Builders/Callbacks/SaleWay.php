<?php

namespace Modules\DesignModel\Builders\Callbacks;

class SaleWay
{
	public function discount($product)
	{
		\Log::info('name: '. $product->name);
		$product->pay_price = ($product->price) * 0.8;
	}

	public static function coupon($rate)
	{
		return function ($product, $number) use ($rate) {
			\Log::info('name: '. $product->name);
			$product->number = $number;
			$product->pay_price = ($product->price) * $rate;
		};
	}
}
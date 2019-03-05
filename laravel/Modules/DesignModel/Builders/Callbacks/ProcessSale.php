<?php

namespace Modules\DesignModel\Builders\Callbacks;

class ProcessSale
{
	private $callbacks = [];

	public function registerCallback($callback)
	{
		if (! is_callable($callback)) {
			throw new \Exception("callback is not able");
		}
		$this->callbacks[] = $callback;
	}

	public function onSale($product, $number)
	{
		foreach ($this->callbacks as $key => $value) {
			call_user_func($value, $product, $number);
		}
	}
}
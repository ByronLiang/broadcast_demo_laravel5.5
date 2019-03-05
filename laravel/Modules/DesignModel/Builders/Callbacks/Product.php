<?php

namespace Modules\DesignModel\Builders\Callbacks;

class Product
{
	public $name, $price;

	public function __construct($name, $price)
	{
		$this->name = $name;
		$this->price = $price;
	}
}
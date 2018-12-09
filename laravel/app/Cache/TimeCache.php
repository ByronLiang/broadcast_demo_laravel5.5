<?php

namespace App\Cache;

use Cache;
use Illuminate\Support\InteractsWithTime;

class TimeCache
{
	use InteractsWithTime;

	public function add()
	{
		return Cache::add('name', 0, 2);
	}

	public function get()
	{
		return Cache::get('name');
	}

	public function inc()
	{
		return Cache::increment('name');
	}

	public function put()
	{
		Cache::put('name', 1, 1);
	}
}
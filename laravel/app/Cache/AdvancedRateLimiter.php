<?php

namespace App\Cache;

use Illuminate\Cache\RateLimiter;

class AdvancedRateLimiter extends RateLimiter
{
	public function show()
	{
		\Log::info('AdvancedRateLimiter_show_function');
	}
}
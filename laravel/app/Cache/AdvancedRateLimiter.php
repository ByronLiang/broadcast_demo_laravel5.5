<?php

namespace App\Cache;

use Illuminate\Cache\RateLimiter;

class AdvancedRateLimiter extends RateLimiter
{
	// 设定一个时长里记录错误登录
	protected $cache_decayMinutes = 2;

	// 调整在一个时长里记录发送错误登录的次数
	/**
     * Increment the counter for a given key for a given decay time.
     *
     * @param  string  $key
     * @param  float|int  $decayMinutes
     * @return int
     */
    public function hit($key, $decayMinutes = 1)
    {
        // $this->cache->add(
        //     $key.':timer', $this->availableAt($decayMinutes * 60), $this->decayCacheMinutes()
        // );

        $added = $this->cache->add($key, 0, $this->decayCacheMinutes());

        $hits = (int) $this->cache->increment($key);

        if (! $added && $hits == 1) {
            $this->cache->put($key, 1, $this->decayCacheMinutes());
        }
        
        return $hits;
    }

    public function decayCacheMinutes()
    {
        return property_exists($this, 'cache_decayMinutes') ? $this->cache_decayMinutes : 1;
    }

    public function start($key, $decayMinutes = 1)
    {
    	$this->cache->add(
            $key.':timer', $this->availableAt($decayMinutes * 60), $this->decayCacheMinutes()
        );
    }

    public function tooManyAttempts($key, $maxAttempts, $decayMinutes = 1)
    {
        if ($this->attempts($key) >= $maxAttempts) {
        	return true;
        }

        return false;
    }
}
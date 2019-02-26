<?php

namespace Modules\RedisTask\Entities;

use Illuminate\Support\Facades\Redis;

class RedisLocker
{
    public function setLocker($key, $try = 3)
    {
        $key = 'locker:1';
        $value = rand(1, 100000);
        for ($i=0; $i < $try; $i++) {
            // 尝试获取redis的分布锁
            $res = Redis::set($key, $value, "nx", "ex", 10);
            \Log::info($res);
            if ($res) {
                \Log::info('get redis locker');
                sleep(3);
                $this->unLocker($key, $value);
                \Log::info('finished unlock redis locker');
                break;
            } else {
                \Log::info('can not get the locker');
                sleep(2);
            }
        }
    }

    public function unLocker($key, $value)
    {
        $script = `if redis.call("get",KEYS[1]) == ARGV[1]
            then
                return redis.call("del",KEYS[1])
            else
                return 0
            end`;

        Redis::eval($script, 1, $key , $value);
    }
}
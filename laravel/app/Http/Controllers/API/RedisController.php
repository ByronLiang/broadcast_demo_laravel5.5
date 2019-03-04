<?php

namespace App\Http\Controllers\API;

use Modules\RedisTask\Entities\RedisLocker;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    /**
     * @OAS\Get(path="/basic_key",tags={"Redis"},
        summary="save or get redis data",description="",
     * @OAS\Parameter(name="id",in="query",description="分类ID",required=false,
     * @OAS\Schema(type="integer",format="int10")),
     * @OAS\Parameter(name="name",in="query",description="分类名称",required=false,
     * @OAS\Schema(type="string")),
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function getKey()
    {
        // $data = Redis::get('email');
        // 获取哈希的数组数据
        $data = Redis::hgetall('category');
        if (is_array($data)) {
            return \Response::success($data);
        } else {
            return \Response::success(compact('data'));
        }
    }

    /**
     * @OAS\Get(path="/store_key",tags={"Redis"},
        summary="store data to redis",description="",
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function storeKey()
    {
        // $zpopped = $this->zpop('zset');
        // \Log::info($zpopped);
        // return \Response::success();
        
        // 事务乐观锁 CAS 写法
        // 可以不设置Options
        $options = [
            'cas' => true,
            // 监听多个键值
            'watch' => ['user:name:1', 'user:name:2'],
            // 设置事务失败, 进行重新请求的次数
            'retry' => 2,
        ];
        try {
            $res = Redis::transaction($options, function ($trans) {
                // watch 与 multi 之间对 观察的key进行变更会有异常抛出
                // $trans->set('user:name:1', 'Jay');
                // 可进行查询其他键的操作
                $trans->get('user:name:1');
                $trans->get('name');
                $trans->multi();
                // 延时时间, 触发对监听的键进行值的变更, 引发对事务的中断
                sleep(5);
                $trans->set('user:name:1', 'superMan111');
                $trans->set('user:name:2', 'bb_byron');
                $trans->hmget('user:2', 'total');
            });
        } catch(\Exception $e) {
            return \Response::error('ss');
        }

        return \Response::success($res);

        // 非事务型的管道模式处理批量操作
        $res = Redis::pipeline(function ($pip) {
            $pip->set('user:1:name', 'Bill');
            $pip->hmset('user:2', [
                'item' => 'sport123', 
                'total' => '33',
            ]);
            $pip->get('name');
        });

        // 将每个批量命令的结构以数组方式返回
        return \Response::success($res);
        
        // 面向过程
        // 事务型处理批量操作; 能确保原子性
        // 发生错误, 所有批量操作都不能生效
        Redis::MULTI();
        Redis::set('name', 'byron111');
        // Redis::hmset('category', '1', 'book', '2', 'film');
        Redis::hmset('user:2', [
            'item' => 'sport', 
            'total' => '23',
        ]);
        Redis::EXEC();

        return \Response::success();
    }

    /**
     * @OAS\Get(path="/lock_key",tags={"Redis"},
        summary="redis to lock a key",description="",
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function setLock(RedisLocker $locker)
    {
        $key = 'locker:1';
        $locker->setLocker($key);

        return \Response::success();
    }

    protected function zpop($key)
    {
        $element = null;
        // Initialize with support for CAS operations
        // Key that needs to be WATCHed to detect changes
        // Number of retries on aborted transactions, after
        // which the client bails out with an exception.
        $options = array(
            'cas' => true,      
            'watch' => $key,    
            'retry' => 3,     
        );

        Redis::transaction($options, function ($tx) use ($key, &$element) {
            @list($element) = $tx->zrange($key, 0, 0);
            if (isset($element)) {
                // With CAS, MULTI *must* be explicitly invoked.
                $tx->multi();
                $tx->zrem($key, $element);
            }
        });

        return $element;
    }

     /**
     * @OAS\Get(path="/slave",tags={"Redis"},
        summary="master and slave to read and write data from redis",description="",
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function redisSlave()
    {
        $master = Redis::connection('default');
        $slave = Redis::connection('slave');
        $master->set('name', 'Beatiful_Beach');
        $data = $slave->get('name');

        return \Response::success(compact('data'));
    }
}

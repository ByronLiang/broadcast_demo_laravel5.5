<?php

namespace App\Http\Controllers\API;

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
        // Redis::set('name', 'byron');
        // Redis::hmset('category', '1', 'book', '2', 'film');
        Redis::hmset('category', [
            '3' => 'sport', 
            '4' => 'music',
        ]);

        return \Response::success();
    }
}

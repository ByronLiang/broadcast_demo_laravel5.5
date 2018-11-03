<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    const PER_PAGE = 15;
   /**
     * @OAS\Get(path="/articles",tags={"Articel"},
        summary="get article data to redis",description="",
     * @OAS\Parameter(name="page",in="query",description="分页",required=false,
     *      @OAS\Schema(type="integer",format="int10")),
     * @OAS\Response(response=200,description="successful operation"),
     *      security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/ 
    public function index()
    {
        $page = request('page') ?? 1;
        $start = ($page - 1) * self::PER_PAGE;
        $end = $start + self::PER_PAGE - 1;
        $data = null;
        // get all the articles data
        // $orders = Redis::ZREVRANGE('time:', 0, -1);
        // also can be design a perpage
        $orders = Redis::ZREVRANGE('time:', $start, $end);
        foreach($orders as $order) {
            $data[] = Redis::hgetall($order);
        }

        return \Response::success($data);
    }

    /**
     * @OAS\Post(path="/articles",tags={"Articel"},
        summary="store article data to redis",description="",
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function store()
    {
        $article_id = Redis::incr('article_id');
        $article = 'article:'. $article_id;
        $time = strtotime('now');
        $data = [
            'id' => $article_id,
            'title' => 'Love',
            'author' => 'Tom',
            'votes' => '0',
            'publish' => $time,
        ];
        Redis::hmset($article, $data);
        Redis::zadd('score:', ($time + 432),  $article);
        Redis::zadd('time:', $time, $article);

        return \Response::success(compact('article_id'));
    }
}

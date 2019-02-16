<?php

namespace App\Http\Controllers\API;

use JSend;
use Illuminate\Http\Request;
use App\Models\Type;
// use App\Http\Controllers\RESTfulTrait;
// use Illuminate\Routing\Controller;
use App\Events\PaperView;

class TypeController extends Controller
{
    // use RESTfulTrait;
    protected $model = Type::class;

    public function __construct()
    {
        parent::__construct();
        // 对指定的控制器方法使用中间件
        $this->middleware('web')->only('testCookie');
    }

    // 接口文档设置要求：
    // 每一个请求参数都是一个Parameter，需要搭配Schema，作为设置请求参数的数据类型

	/**
     * @OAS\Get(path="/type",tags={"Type"},
        summary="Just some data list",description="",
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
    public function getIndex(Request $request)
    {
        $data = Type::filter($request->all())->limit(5)->get();

        return \Response::success($data);
    }

    /**
     * @OAS\Get(path="/event",tags={"Type"},
        summary="Test some Event",description="",
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
    public function getEvent()
    {
        event(new PaperView('abc'));

        return \Response::success();
    }

    /**
     * @OAS\Get(path="/cookie_test",tags={"Type"},
        summary="About the use of cookie",description="",
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function testCookie()
    {
        if (request()->cookie('asv')) {
            $res = 'abc agent: '. request()->userAgent(). 'IP: '. request()->cookie('asv');
            request()->merge(compact('res'));

            return \Response::success(request()->all());
        } else {
            // cookie队列 配合web的中间件AddQueuedCookiesToResponse
            cookie()->queue('asv', 'abc', 10);
            // 无需建立中间件
            // setCookie('asv', 'abc', time() + 60 * 10, '/');
        }
        $res = 'abc agent: '. request()->userAgent(). 'IP: '. request()->IP() . '/' .request()->cookie('asv');
        request()->merge(compact('res'));

        return \Response::success(request()->all());
    }
}

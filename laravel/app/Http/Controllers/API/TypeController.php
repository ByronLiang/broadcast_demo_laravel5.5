<?php

namespace App\Http\Controllers\API;

use JSend;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Http\Controllers\RESTfulTrait;
// use Illuminate\Routing\Controller;

class TypeController extends Controller
{
    // use RESTfulTrait;
    protected $model = Type::class;

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
        // return $this->index();
        $data = Type::filter($request->all())->limit(5)->get();

        return \Response::success($data);
    }
}

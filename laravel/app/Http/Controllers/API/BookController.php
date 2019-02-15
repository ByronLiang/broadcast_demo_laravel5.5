<?php

namespace App\Http\Controllers\API;

use App\Models\DouBanBook;
use App\Http\Requests\API\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * @OAS\Get(path="/books",tags={"Book"},
        summary="fetch dou ban book data",description="",
     * @OAS\Parameter(name="id",in="query",description="分类ID",required=false,
     * @OAS\Schema(type="integer",format="int10")),
     * @OAS\Parameter(name="name",in="query",description="分类名称",required=false,
     *      @OAS\Schema(type="string")),
     * @OAS\Parameter(name="start",in="query",description="起始数目",required=false,
     *      @OAS\Schema(type="integer",format="int10")),
     * @OAS\Parameter(name="count",in="query",description="数据数目",required=false,
     *      @OAS\Schema(type="integer",format="int10")),
     * @OAS\Parameter(name="keyword",in="query",description="关键词",required=false,
     *      @OAS\Schema(type="string")),
     * @OAS\Parameter(name="type",in="query",description="实时查询",required=false,
     *      @OAS\Schema(type="string")),
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function index()
    {
        if (request('type')) {
            $data = \DouBan::fetcheBookData(
                request('keyword'), 
                request('start'), 
                request('count')
            );
        } else {
            $data = DouBanBook::paginate();
        }

        return \Response::success($data);
    }

    public function show()
    {

    }

    /**
     * @OAS\Post(path="/books",tags={"Book"},
        summary="store dou ban book data",description="",
     * @OAS\Parameter(name="start",in="query",description="起始数目",required=false,
     *      @OAS\Schema(type="integer",format="int10")),
     * @OAS\Parameter(name="count",in="query",description="数据数目",required=false,
     *      @OAS\Schema(type="integer",format="int10")),
     * @OAS\Parameter(name="name",in="query",description="关键词",required=false,
     *      @OAS\Schema(type="string")),
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function store()
    {
        $books = \DouBan::fetcheBookData(
            request('name'), 
            request('start'), 
            request('count')
        );
        foreach($books as $book) {
            DouBanBook::create([
                'title' => $book['title'] ?? '',
                'subtitle' => $book['subtitle'],
                'author' => array_first($book['author']),
                'tags' => collect($book['tags'])->pluck('title')->toArray(),
                'image' => $book['image'],
                'publisher' => $book['publisher'],
            ]);
        }

        return \Response::success();
    }

    /**
     * @OAS\Put(path="/books/{id}",tags={"Book"},
        summary="update dou ban book data",description="",
     *  @OAS\Parameter(name="id",in="path",description="bookId",required=true,
     *      @OAS\Schema(type="integer",format="int10")),
     *  @OAS\RequestBody(required=true,description="",
     *     @OAS\MediaType(mediaType="application/json",
     *        @OAS\Items(ref="#/components/schemas/UpdateBookRequest")
     *     )
     *  ),
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function update(UpdateBookRequest $requset, $id)
    {
        DouBanBook::find($id)
            ->update([
                'title' => $requset->content,
            ]);
        
            return \Response::success();
    }

    public function destory()
    {

    }
}

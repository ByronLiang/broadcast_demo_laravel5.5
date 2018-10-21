<?php

namespace App\Http\Controllers\API;

use App\Models\DouBanBook;
use App\Services\DouBanDataService;

class BookController extends Controller
{
    /**
     * @OAS\Get(path="/books",tags={"Book"},
        summary="fetch dou ban book data",description="",
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
    public function index()
    {
        // $douban = new DouBanDataService();
        // $data = $douban->fetchMovieData(10, 5);
        $data = DouBanBook::paginate();

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
        $douban = new DouBanDataService();
        $books = $douban->fetcheBookData(request('name'), request('start'), request('count'));
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

    public function update()
    {

    }

    public function destory()
    {

    }
}

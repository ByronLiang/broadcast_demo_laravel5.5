<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Author;

class FollowController extends Controller
{
	/**
     * @OAS\Get(path="/follows",tags={"Follow"},
        summary="fetch the follower from an author data",description="",
     * @OAS\Parameter(name="author_id",in="query",description="author_ID",required=false,
     * @OAS\Schema(type="integer",format="int10")),
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function index()
    {
    	$author = Author::with('followers')
    		->find(request('author_id') ?? 1);

    	return \Response::success($author);
    }

    /**
     * @OAS\Post(path="/follows",tags={"Follow"},
        summary="store follow or unfollow the author",description="",
     * @OAS\Parameter(name="id",in="query",description="author id ",required=true,
     *      @OAS\Schema(type="integer",format="int10")),
     * @OAS\Response(response=200,description="successful operation"),
     * security={{"bearerAuth": {}}},
     *   
     * )
     *
	**/
    public function store()
    {
    	$author = Author::findorFail(request('id'));
    	$this->my->toggleFollow($author, Author::class);

    	return \Response::success();
    }
}

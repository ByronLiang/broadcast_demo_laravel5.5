<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Author;

class HomeController extends Controller
{
    public function index()
    {
    	$banner = Banner::where('status', 1)->get();
    	$author = Author::limit(6)->get();

    	return \Response::success(compact('banner', 'author'));
    }
}

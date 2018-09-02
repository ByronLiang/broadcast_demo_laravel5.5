<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Author;
use App\Services\ExcelService;

class HomeController extends Controller
{
    public function index()
    {
    	$banner = Banner::where('status', 1)->get();
    	$author = Author::with('room')->limit(6)->get();

    	return \Response::success(compact('banner', 'author', 'index'));
    }

    public function test(Request $request)
    {
    	// $a = collect(['hi', 'dear'])->ac();
    	// dd($a);
        $excel = new ExcelService();
        $excel->test();
        dd('aa');
    }
}

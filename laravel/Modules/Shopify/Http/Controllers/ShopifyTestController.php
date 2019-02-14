<?php

namespace Modules\Shopify\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Shopify\Builder\Test;

class ShopifyTestController extends Controller
{
    public function index(Test $test)
    {
        return $test->da('32', '312', 'sk');

        return view('shopify::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('shopify::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        if (request()->cookie('test_cookie')) {
            dd(request()->cookie('test_cookie'));
        } else {
            // 将cookie值放置在响应的队列里, 中间件AddQueuedCookiesToResponse进行放置在响应里
            cookie()->queue('test_cookie', 'hello', 1);
        }

        return view('shopify::index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('shopify::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}

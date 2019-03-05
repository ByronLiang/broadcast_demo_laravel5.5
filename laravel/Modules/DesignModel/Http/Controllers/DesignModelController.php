<?php

namespace Modules\DesignModel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DesignModel\Builders\Callbacks\{ProcessSale, Product, SaleWay};

class DesignModelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ProcessSale $process)
    {
        $product = new Product('apple', '200');
        // $process->registerCallback([(new SaleWay()), 'discount']);
        $process->registerCallback(SaleWay::coupon('0.95'));
        $process->onSale($product, 2);
        dd($product);
        return view('designmodel::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('designmodel::create');
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
        return view('designmodel::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('designmodel::edit');
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

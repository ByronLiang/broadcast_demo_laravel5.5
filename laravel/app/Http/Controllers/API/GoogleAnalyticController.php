<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Analytics;

class GoogleAnalyticController extends Controller
{
    public function index()
    {
        Analytics::setDateRange('2019-03-01', '2019-03-05');
        Analytics::setDimension(['ga:date']);
        Analytics::setMetrics(['ga:sessions']);
        $data = Analytics::get();
        dd($data);
        return \Response::success($data);
    }
}

<?php

namespace App\Http\Controllers\Callback;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    public function callback($channel, Request $request)
    {
    	\Log::info('callback_request: '. $request->all());

    	return \Response::success();
    }

    public function returnCallback(Request $request)
    {
    	\Log::info('return: '. $request->all());
    	
    	return \Response::success();
    }
}

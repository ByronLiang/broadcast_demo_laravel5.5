<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;

class ChatController extends Controller
{
    public function fetchChatRoomInfo()
    {
    	$model = Author::findorFailed(request('id'));

    	return \Response::success($model);
    }
}

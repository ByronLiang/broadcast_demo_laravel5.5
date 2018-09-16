<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\ChatMessage;
use App\Events\{MessagePosted, FinishedPurchase};

class ChatController extends Controller
{
    public function fetchChatRoomInfo()
    {
    	$model = Author::with(['messages' => function ($q) {
            // 显示最近五条消息
            $q->with('user')->orderBy('created_at')->limit(5);
        }])
    	->findorFail(request('id'));

    	return \Response::success($model);
    }

    public function index()
    {

    }

    public function store()
    {
    	$user = auth()->user();
    	$message = ChatMessage::create([
    		'author_id' => request('author'),
    		'user_id' => $user->id,
    		'message' => request('message'),
    	]);
        $message['user'] = $user;
        // dd($message);
    	// Announce that a new message has been posted
        // 传入当前的作者ID（信道ID）
    	broadcast(new MessagePosted($message, $user, request('author')))
    		->toOthers();
    	
    	return \Response::success($user);
    }

    public function finishedPay()
    {
        broadcast(new FinishedPurchase(request('author')))
            ->toOthers();
        return \Response::success();
    }
}

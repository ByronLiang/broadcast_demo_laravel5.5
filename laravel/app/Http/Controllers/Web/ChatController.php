<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\ChatMessage;
use App\Events\MessagePosted;

class ChatController extends Controller
{
    public function fetchChatRoomInfo()
    {
    	$model = Author::with('messages.user')
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
    	broadcast(new MessagePosted($message, $user))
    		->toOthers();
    	
    	return \Response::success($user);
    }
}

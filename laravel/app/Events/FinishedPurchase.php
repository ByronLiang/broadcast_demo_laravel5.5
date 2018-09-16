<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FinishedPurchase implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $authorId; 
    
    public function __construct($authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chatroom'.$this->authorId);
        // return new PrivateChannel('channel-name');
    }

    // 自定义广播消息数据结构
    // public function broadcastWith()
    // {
    //     $pack = [
    //         'author' => $this->authorId,
    //         'message' => 'abc',
    //         'user' => auth()->user(),
    //     ];

    //     return $pack;
    // }
}

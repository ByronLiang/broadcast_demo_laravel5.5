<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class RedisChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toRedis($notifiable);
        \Log::info('user_id: '. $notifiable->id);
        if (is_array($message)) {
            \Log::info(json_encode($message));
        } else {
            \Log::info('message: '. $message);
        }
        // Send notification to the $notifiable instance...
    }
}
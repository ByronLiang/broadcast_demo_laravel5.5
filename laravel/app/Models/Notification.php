<?php

namespace App\Models;

class Notification extends \Illuminate\Notifications\DatabaseNotification
{
    public function getDataAttribute()
    {
    	$data = json_decode($this->attributes['data']);
    	$data->msg_type = 'news';

        return $data;
    }
}

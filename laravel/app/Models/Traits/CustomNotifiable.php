<?php

namespace App\Models\Traits;

use App\Models\Notification;
use Illuminate\Notifications\Notifiable;

trait CustomNotifiable
{
	use Notifiable;

	public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')
                            ->orderBy('created_at', 'desc');
    }
}
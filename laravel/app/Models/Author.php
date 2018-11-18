<?php

namespace App\Models;

use Modules\Follow\Entities\Traits\CanBeFollowed;

class Author extends Model
{
	use CanBeFollowed;

    public function messages()
    {
    	return $this->hasMany(ChatMessage::class);
    }

    public function room()
    {
    	return $this->hasOne(AuthorChatRoom::class);
    }
}

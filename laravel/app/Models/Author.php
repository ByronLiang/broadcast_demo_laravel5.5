<?php

namespace App\Models;

class Author extends Model
{
    public function messages()
    {
    	return $this->hasMany(ChatMessage::class);
    }
}

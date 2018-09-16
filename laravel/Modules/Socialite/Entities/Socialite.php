<?php

namespace Modules\Socialite\Entities;

class Socialite extends \App\Models\Model
{
    protected $casts = [
        'extend' => 'object',
    ];

    public function able()
    {
        return $this->morphTo();
    }

    public static function whereUniqueId($value)
    {
        return static::where('unique_id', $value);
    }
}

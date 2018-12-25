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

    public function setAble(\App\Models\Model $able)
    {
        $this->able_id = $able->getKey();
        $this->able_type = get_class($able);
        $this->save();

        return $this;
    }
}

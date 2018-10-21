<?php

namespace App\Models;

use App\Models\Observers\BookObserver;

class DouBanBook extends Model
{
    protected $casts = [
        'tags' => 'array',
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(BookObserver::class);
    }
}

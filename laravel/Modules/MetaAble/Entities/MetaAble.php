<?php

namespace Modules\MetaAble\Entities;

class MetaAble extends \App\Models\Model
{
    public $timestamps = false;

    protected $guarded = ['id', 'metable_type', 'metable_id', 'type'];

    protected $attributes = [
        'value' => '',
    ];

    public function able()
    {
        return $this->morphTo();
    }

    public function getRawValue()
    {
        return $this->attributes['value'];
    }
}

<?php

namespace App\Models;

class Catagory extends Model
{
    public $timestamps = false;

    protected $table = 'catagory';

    protected static function boot()
    {
        parent::boot();
        // 监听模型的更新与添加事件
        static::saved(function ($author) {
            self::updateCachedAll();
        });
        // 删除数据：deleting，deleted 事件监听
        static::deleted(function($author) {
            self::updateCachedAll();
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_catagory');
    }
}

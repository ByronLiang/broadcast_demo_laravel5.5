<?php

namespace App\Models\Observers;

class BookObserver
{
    public function creating($model)
    {
        if ($model->author) {
            \Log::info('data: '. $model->author);
        }
    }

    public function updating($model)
    {
        $changed = $model->isDirty() ? $model->getDirty() : false;
        if (is_array($changed)) {
            // 返回所有变更字段的数组与对应的新值
            \Log::info('all changed array: '. json_encode($changed));
        }
        // 对指定字段的变更进行判断
        if ($model->isDirty('title')) {
            $oldTitle = $model->getOriginal('title');
            $nowTitle = $model->title;
            \Log::info('updating_info: old_title: '. $oldTitle. ' new_title: '. $nowTitle);
        }
    }
}
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
}
<?php

namespace App\Listeners;

use App\Events\PaperView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaperViewNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaperView  $event
     * @return void
     */
    public function handle(PaperView $event)
    {
        \Log::info('listener');
    }
}

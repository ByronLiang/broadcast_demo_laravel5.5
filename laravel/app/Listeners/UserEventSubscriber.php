<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\PaperView;

class UserEventSubscriber
{
    public function onPaperView($event)
    {
        \Log::info('PaperView Eventss');
        \Log::info('the word is '. $event->word);
    }
    /**
     * 处理用户登录事件.
     * @translator laravelacademy.org
     */
    public function onUserLogin($event) {
        \Log::info('the User are Login');
    }

    /**
     * 处理用户退出事件.
     */
    public function onUserLogout($event) {
        \Log::info('the User are Logout');
    }

    /**
     * 为订阅者注册监听器.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        // 批量进行事件监听
        $events->listen(
            PaperView::class,
            'App\Listeners\UserEventSubscriber@onPaperView'
        );

        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
    }
}

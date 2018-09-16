<?php

namespace Modules\Sms\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Sms\Events\CaptchaEvent;
use Overtrue\EasySms\EasySms;

class CaptchaListener
{
    protected $easySms;

    protected $template;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->easySms = new EasySms(config('sms'));
    }

    /**
     * @param CaptchaEvent $event
     * @return mixed
     * @throws \Overtrue\EasySms\Exceptions\InvalidArgumentException
     * @throws \Overtrue\EasySms\Exceptions\NoGatewayAvailableException
     */
    public function handle(CaptchaEvent $event)
    {
        if (!$event->captcha) {
            return $this->easySms->send($event->phone, [
                'content' => $this->content($event),
                'template' => $this->template,
                'data' => $this->data($event),
            ]);
        }
        return $event->captcha == $this->captcha($event, true) ? true : new \Exception('验证码错误', 403);
    }

    public function data(CaptchaEvent $event)
    {
        return [
            'code' => $this->captcha($event)
        ];
    }

    public function captcha(CaptchaEvent $event, $is_pull = false)
    {
        $cache_key = 'captcha_' . $event->phone;
        $code = rand(1111, 9999);
        if (\Cache::has($cache_key)) {
            return $is_pull ? \Cache::get($cache_key) : \Cache::pull($cache_key);
        }
        \Cache::put($cache_key, $code, 1);
        return $code;
    }

    public function content(CaptchaEvent $event)
    {
        return '您的验证码为: ' . $this->captcha($event);
    }
}

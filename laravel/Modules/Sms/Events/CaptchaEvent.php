<?php

namespace Modules\Sms\Events;

use Illuminate\Queue\SerializesModels;

class CaptchaEvent
{
    use SerializesModels;

    public $phone;
    public $captcha;

    public function __construct($phone, $captcha = null)
    {
        $this->phone = $phone;
        $this->captcha = $captcha;
    }

    public function broadcastOn()
    {
        return [];
    }
}

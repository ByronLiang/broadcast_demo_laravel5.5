<?php

namespace App\Services;

use Mail;

class EmaillService
{
    public function sendMail($account, $code, $title)
    {
        $account = $account;
        $code = $code;
        Mail::send('email.index', compact('account', 'code'), function($message) use ($account, $title) {
            $to = $account;
            $message->to($to)->subject($title);
        });
    }
}

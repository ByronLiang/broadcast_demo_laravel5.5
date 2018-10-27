<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LoginRequest;
use App\Services\EmaillService;

class AuthController extends Controller
{
    public function postLogin(LoginRequest $request)
    {
        if (auth()->attempt($request->extractInputFromRules(), $request->remember)) {
            return \Response::success(auth()->user());
        }

        return \Response::error('账号或者密码错误');
    }

    public function getCaptcha()
    {
        switch (request('type')) {
            case 'email':
                return $this->getEmailCaptcha();
            case 'pic':
                return $this->getPicCaptcha();
            default:
                return $this->getPicCaptcha();
        }
    }

    protected function getPicCaptcha()
    {
        $captcha = captcha_src();

        return \Response::success(compact('captcha'));
    }

    protected function getEmailCaptcha(EmaillService $email)
    {
        $captcha = rand(1111, 9999);
        // 邮箱发送验证码
        $email->sendMail(request('account'), $captcha, '邮箱验证码');

        return \JSend::success(compact('captcha'));
    }
}

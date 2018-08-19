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

    public function getCaptcha(EmaillService $email)
    {

        $captcha = rand(1111, 9999);
        // 邮箱发送验证码
        $email->sendMail(request('account'), $captcha, '邮箱验证码');

        return \JSend::success(compact('captcha'));
    }
}

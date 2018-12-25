<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests\API\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Cache\AdvancedRateLimiter;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{   
    use ThrottlesLogins;

    protected $maxAttempts = 2;

    /**
     * @OAS\Post(path="/login",tags={"Auth"},
        summary="login the system",description="",
     *  @OAS\RequestBody(required=true,description="",
     *     @OAS\MediaType(mediaType="application/json",
     *        @OAS\Items(ref="#/components/schemas/AuthRequest")
     *     )
     *  ),
     * @OAS\Response(response=200,description="successful operation"),
     * )
     **/
    public function login(AuthRequest $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            // $this->fireLockoutEvent($request);
            // 触发限制的登录失败次数才开始进行计时
            $this->startLimitLogin($request);

            return $this->sendLockoutResponse($request);
        }
        $user = $this->authGuard()->attempt($request->extractInputFromRules());
        if ($user) {
            return \Response::success($this->authGuard()->user());
        } else {
            // count the failed login time
            $this->incrementLoginAttempts($request);

            return \Response::error('login error');
        }
    }

    public function username()
    {
        return 'phone';
    }

    protected function authGuard()
    {
        return Auth::guard('web');
    }

    protected function limiter()
    {
        return app(AdvancedRateLimiter::class);
    }

    protected function sendLockoutResponse(AuthRequest $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        return \Response::error(Lang::get('auth.throttle', ['seconds' => $seconds]));
    }

    protected function startLimitLogin(AuthRequest $request)
    {
        $this->limiter()->start(
            $this->throttleKey($request), $this->decayMinutes()
        );
    }

    /**
     * @OAS\Get(path="/oauth/{provider}",tags={"认证"},summary="第三方授权登陆|重定向到此链接即可",description="
     当处于已登录状态下，PC端使用此接口来绑定未曾绑定第三方的账号信息 只返回success状态
     未登录下, 进行创建用户与返回user对象
     ",
     *     @OAS\Parameter(name="provider",in="path",description="第三方（wechat_public,facebook,twitter）",@OAS\Schema(type="string")),
     *     @OAS\Parameter(name="return",in="query",description="授权成功后返回的链接",@OAS\Schema(type="string")),
     *     @OAS\Response(response=200,description="successful operation",@OAS\MediaType(mediaType="application/json")),
     *     security={{"bearerAuth": {}}},
     * ),
     */
    public function getOauth($provider)
    {
        $return = request('return');
        $return = $return ?: 'https://www.baidu.com';
        $res = (new \Modules\Socialite\Platforms\Factory($provider))->handle($return);

        if ($res instanceof \Modules\Socialite\Entities\Socialite) {
            $socialite = $res;
            // if (auth()->check()) {
            //     // 识别已登录, PC端绑定第三方账号
            //     $this->my->socialite()->create([
            //         'provider' => $provider,
            //         'unique_id' => $socialite->id,
            //         'nickname' => $socialite->nickname,
            //         'avatar' => $socialite->avatar,
            //     ]);

            //     return \Response::success();
            // }
            $user = $socialite->able;
            if (!$user) {
                $user = User::create([
                    'name' => $socialite->nickname,
                    'avatar' => $socialite->avatar,
                ]);
                $socialite->setAble($user);
                $user->showAndUpdateApiToken();
            } else {
                $user->showAndUpdateApiToken();
            }
        } elseif (false === $res) {
            return redirect($return);
        } else {
            return $res;
        }

        $return .= false === strpos($return, '?') ? '?' : '&';
        $return .= 'api_token='.$user->api_token;

        return redirect($return);
    }
}

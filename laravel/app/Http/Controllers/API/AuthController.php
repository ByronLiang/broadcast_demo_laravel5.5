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
}

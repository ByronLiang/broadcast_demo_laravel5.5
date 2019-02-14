<?php

namespace Modules\Socialite\Platforms;

class Factory
{
    protected $provider;

    private $platform;

    public function __construct($provider = null)
    {
        switch ($provider) {
            case 'github':
                $this->platform = (new GitHubFactory());
                break;
            case 'line':
                $this->platform = (new LineFactory());
                break;
            case 'facebook':
                $this->platform = (new FaceBookFactory());
                break;
            default:
                abort(400, '不支持此登录模式');
                break;
        }

        if (!$this->platform instanceof FactoryInterface) {
            abort(500, '不支持此登录模式');
        }

        $this->provider = $provider;
    }

    public function handle()
    {
        $res = $this->platform->handle();
        // 判断返回的是否为整型, 首次请求接口进行三方授权不是返回布尔值
        if (!is_bool($res)) {
            return $res;
        }

        if (!$res) {
            return $res;
        }

        return $this->platform->socialite($this->provider);
    }

    public function getRequestHandle($base_path = '/')
    {
        $cache_key = null;
        $cookie_key = md5(request()->userAgent().request()->getClientIp().__METHOD__);
        $return = request('return');
        // 无需移除web的中间件的Cookie加密, 使用原生获取Cookie值
        // if(isset($_COOKIE[$cookie_key])) {
        //     $cache_key = $_COOKIE[$cookie_key];
        // }
        $cache_key = request()->cookie($cookie_key);
        if ($cache_key && !$return && \Cache::has($cache_key)) {
            request()->merge(\Cache::get($cache_key));

            return $this;
        }

        $cache_key = $cookie_key.uniqid();

        $return = $return ?: request()->header('referer');
        $return = $return ?: $base_path;
        request()->merge(compact('return'));
        // 获取请求路由的所有中间件 返回数组
        // request()->route()->middleware();
        if (in_array('web', request()->route()->middleware())) {
            // 判别当使用web中间件, 使用Laravel内置的cookie进行建立值, 确保取值不为已加密的值
            cookie()->queue(cookie()->make($cookie_key, $cache_key, 10));
        } else {
            // 其余组件可使用原生cookie进行值存储
            setrawcookie($cookie_key, $cache_key, time() + 60 * 10, '/');
        }
        \Cache::put($cache_key, request()->all(), 10);

        return $this;
    }
}
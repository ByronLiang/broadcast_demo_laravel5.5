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

    public function handle($return)
    {
        $res = $this->platform->handle($return);
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
        $cookie_key = md5(request()->userAgent().request()->getClientIp().__METHOD__);
        $return = request('return');
        $cache_key = request()->cookie($cookie_key);

        if ($cache_key && !$return && \Cache::has($cache_key)) {
            request()->merge(\Cache::get($cache_key));

            return $this;
        }

        $cache_key = $cookie_key.uniqid();

        $return = $return ?: request()->header('referer');
        $return = $return ?: $base_path;
        request()->merge(compact('return'));

        setrawcookie($cookie_key, $cache_key, time() + 60 * 10, '/');

        \Cache::put($cache_key, request()->all(), 10);

        return $this;
    }
}
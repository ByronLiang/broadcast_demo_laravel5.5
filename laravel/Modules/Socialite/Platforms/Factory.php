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
}
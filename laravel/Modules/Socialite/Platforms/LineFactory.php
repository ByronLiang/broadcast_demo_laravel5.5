<?php

namespace Modules\Socialite\Platforms;

use Modules\Socialite\Entities\Socialite as EntitySocialite;
use App\Models\User;

class LineFactory implements FactoryInterface
{
    public $socialite;

    protected $user;

    public function __construct()
    {
        $this->socialite = \Socialite::driver('line');
    } 

    public function handle(string $return = '')
    {
        if (request('state')) {
            if (request('code')) {
                // 需要对return_url进行校验
                $this->socialite->redirectUrl(request()->url().'?return='.urlencode($return));
                // 使用session无状态登录
                $this->user = $this->socialite->user();

                return true;
            }
            abort(400, request('error_description'));

            return false;
        }
        return $this->socialite
            ->redirectUrl(request()->url().'?return='.urlencode($return))
            ->redirect();
    }

    // 统一返回Socialite模型
    public function socialite(string $provider): EntitySocialite
    {
        $user = $this->user;
        $unionId = $user->getId();
        if ($unionId) {
            if ($socialite = EntitySocialite::where('unique_id', $unionId)->first()) {
                return $socialite;
            } else {
                // 统一返回User模型
                // $my = User::create([
                //     'avatar' => $user->getAvatar(),
                //     'name' => $user->getNickname(),
                // ]);
                // $my->socialite()->create([
                //     'provider' => $provider,
                //     'unique_id' => $user->getId(),
                //     'avatar' => $user->getAvatar(),
                //     'nickname' => $user->getNickname(),
                // ]);

                // return $my->socialite;

                $socialite = EntitySocialite::create([
                    'provider' => $provider,
                    'unique_id' => $user->getId(),
                    'avatar' => $user->getAvatar(),
                    'nickname' => $user->getNickname() ?? $user->getName(),
                ]);
        
                return $socialite;
            }
        }
    }
}
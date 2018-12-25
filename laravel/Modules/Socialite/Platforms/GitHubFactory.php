<?php

namespace Modules\Socialite\Platforms;

use Modules\Socialite\Entities\Socialite as EntitySocialite;
use App\Models\User;

class GitHubFactory implements FactoryInterface
{
    public $socialite;

    protected $user;

    public function __construct()
    {
        $this->socialite = \Socialite::driver('github');
    } 

    public function handle(string $return = '')
    {
        if (request('state')) {
            if (request('code')) {
                $this->user = $this->socialite->stateless()->user();

                return true;
            }
            abort(400, request('error_description'));

            return false;
        }

        return $this->socialite->redirectUrl(request()->url())->redirect();
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
                    'nickname' => $user->getNickname(),
                ]);
        
                return $socialite;
            }
        }
    }
}
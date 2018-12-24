<?php

namespace Modules\Socialite\Platforms;

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
                \Log::info('github callback request: '. json_encode(request()->all()));
                $this->user = $this->socialite->stateless()->user();

                return true;
            }
            abort(400, request('error_description'));
            return false;
        }

        return $this->socialite->redirectUrl(request()->url())->redirect();
    }
}
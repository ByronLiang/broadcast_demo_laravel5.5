<?php

namespace Modules\Socialite;

use Modules\Socialite\Entities\Socialite;

/**
 * @mixin \Eloquent
 */
trait SocialiteTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany|Socialite
     */
    public function socialites()
    {
        return $this->morphMany(Socialite::class, 'able');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne|Socialite
     */
    public function socialite()
    {
        return $this->morphOne(Socialite::class, 'able');
    }
}
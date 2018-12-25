<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Models\Traits\SafetyPassword;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Follow\Entities\Traits\CanFollow;
use Modules\Socialite\SocialiteTrait;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, SafetyPassword, SoftDeletes, Notifiable;
    use \EloquentFilter\Filterable;
    use CanFollow;
    use SocialiteTrait;

    public function showAndUpdateApiToken(array $other_data = [])
    {
        foreach ($other_data as $k => $v) {
            $this->{$k} = $v;
        }
        $this->api_token = str_random(64);
        $this->makeVisible('api_token');
        $this->save();

        return $this;
    }
}

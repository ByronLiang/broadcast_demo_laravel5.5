<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Models\Traits\SafetyPassword;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Follow\Entities\Traits\CanFollow;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, SafetyPassword, SoftDeletes, Notifiable;
    use \EloquentFilter\Filterable;
    use CanFollow;
}

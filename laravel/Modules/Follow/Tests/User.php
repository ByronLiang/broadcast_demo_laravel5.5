<?php

/*
 * This file is part of the overtrue/laravel-follow
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Modules\Follow\Tests;

use Illuminate\Database\Eloquent\Model;
use Modules\Follow\Entities\Traits\CanFollow;
use Modules\Follow\Entities\Traits\CanBeFollowed;
use Modules\Follow\Entities\Traits\CanFavorite;

class User extends Model
{
    use CanFollow, CanBeFollowed, CanFavorite;

    protected $fillable = ['name'];
}

<?php

namespace Modules\Follow\Entities;

use Illuminate\Database\Eloquent\Model;

class Followable extends Model
{
    protected $visible = ['id', 'user_id'];
}

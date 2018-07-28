<?php

namespace App\Models;

use EloquentFilter\Filterable;

class Type extends Model
{
	use Filterable;

    protected $table = 'catagory';
}

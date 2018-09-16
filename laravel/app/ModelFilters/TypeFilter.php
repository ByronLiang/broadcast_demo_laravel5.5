<?php 

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

class TypeFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function boot()
    {
        return $this->orderBy('id', 'desc');
    }

    public function name($val)
    {
    	return $this->where('name', 'like', '%'.$val.'%');
    }

    public function id($val)
    {
    	return $this->where('id', $val);
    }

    public function setup()
    {
        return $this->orderBy('id', 'desc');
    }
}

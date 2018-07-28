<?php

namespace App\ModelFilters;

abstract class ModelFilter extends \EloquentFilter\ModelFilter
{
    public function __construct($query, array $input = [], bool $relationsEnabled = true)
    {
        parent::__construct($query, $input, $relationsEnabled);
        if (method_exists($this, 'boot')) {
            $this->boot();
        }
    }
}
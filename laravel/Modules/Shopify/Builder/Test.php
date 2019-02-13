<?php

namespace Modules\Shopify\Builder;

class Test
{
    public function __call($name, $arguments)
    {
        if ($name == 'haha') {
            return (new self())->default();
        } else {
            // throw new \Exception('bad method');
            if (!empty($arguments)) {
                return 'sakajkls'. $arguments[0];
            } else {
                return 'simple';
            }
            
        }
    }

    public function default()
    {
        return 'super haha';
    }

    public function init()
    {
        return 'abc';
    }
}
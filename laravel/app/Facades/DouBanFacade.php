<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class DouBanFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DouBan';
    }
}
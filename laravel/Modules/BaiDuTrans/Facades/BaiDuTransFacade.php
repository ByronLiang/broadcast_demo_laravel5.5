<?php

namespace Modules\BaiDuTrans\Facades;

use Illuminate\Support\Facades\Facade;

class BaiDuTransFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'BaiDuTrans';
    }
}
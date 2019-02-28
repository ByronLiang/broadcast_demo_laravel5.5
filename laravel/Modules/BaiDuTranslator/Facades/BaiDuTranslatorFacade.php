<?php

namespace Modules\BaiDuTranslator\Facades;

use Illuminate\Support\Facades\Facade;

class BaiDuTranslatorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'BaiDuTranslator';
    }
}
<?php

namespace Modules\BaiDuTranslator\Entities\Traits;

trait SignTrait
{
    public function createSalt()
    {
        return rand(10000,99999);
    }

    public function createSign($query, $appId, $salt, $secretKey)
    {
        $str = $appId . $query . $salt . $secretKey;

        return md5($str);
    }
}
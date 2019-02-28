<?php

namespace Modules\BaiDuTranslator\Entities\Traits;

trait Publics
{
    // 获取一个类的所有公共属性
    public function publics()
    {
        $public_properties = [];
        $varArray = get_object_vars($this);
        $ref = new \ReflectionClass($this);
        $data = $ref->getProperties(\ReflectionProperty::IS_PUBLIC);
        foreach ($data as $value) {
            if (isset($varArray[$value->getName()])) {
                $public_properties = array_merge(
                    $public_properties, 
                    [$value->getName() => $varArray[$value->getName()]]
                );
            }
        }

        return $public_properties;
    }
}
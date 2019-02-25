<?php

namespace Modules\BaiDuTrans\Entities;

class BaiduTranslator
{
    private static $url = 'http://api.fanyi.baidu.com/api/trans/vip/translate';

    private static $instance;

    protected $config = [];

    protected $resources = [
        'BaseTranslator',
    ];

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct()
    {
        $this->config = config('baidu_trans');
        $this->config['url'] = static::$url;
    }

    public function __call($resourceName, $arguments)
    {
        if (! in_array($resourceName, $this->resources)) {
            $message = "Invalid resource name ". $resourceName;

            throw new \Exception($message);
        }
        $resourceClassName = __NAMESPACE__ . "\\$resourceName";
        $resource = new $resourceClassName($this->config);

        return $resource;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
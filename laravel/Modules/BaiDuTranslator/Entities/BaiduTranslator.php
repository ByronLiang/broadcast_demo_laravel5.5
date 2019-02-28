<?php

namespace Modules\BaiDuTranslator\Entities;

class BaiduTranslator
{
    private static $url = 'http://api.fanyi.baidu.com/api/trans/vip/translate';

    // 限定有效的译文语言
    public static $validTranslatorLanguages = [
        'zh', 'en', 'yue', 'wyw', 'jp', 'kor', 'fra', 'spa', 'th', 'ara', 'ru', 'cht',
    ];

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
        $this->config = config('baidu_translator');
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
}
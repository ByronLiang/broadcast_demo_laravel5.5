<?php

namespace Modules\BaiDuTrans\Entities;

use Modules\BaiDuTrans\Entities\Traits\SignTrait;
use Modules\BaiDuTrans\Entities\BaiduTranslatorResource;
use Modules\BaiDuTrans\Entities\Interfacts\TranslatorInterface;

class BaseTranslator extends BaiduTranslatorResource implements TranslatorInterface
{
    use SignTrait;

    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function initQuery($query, $to, $from)
    {
        $salt = $this->createSalt();
        $args = [
            'q' => $query,
            'appid' => $this->config['app_id'],
            'salt' => $salt,
            'from' => $from,
            'to' => $to,
        ];
        $args['sign'] = $this->createSign(
            $query, 
            $this->config['app_id'], 
            $salt, 
            $this->config['app_secret']
        );

        return $args;
    }

    public function translateOne(string $word, string $to, string $from = ''): string
    {
        $ret = $this->call(
            $this->config['url'], 
            $this->config['curl_timeout'], 
            $this->initQuery($word, $to, $from ?: 'auto')
        );
        $ret = json_decode($ret, true);
        if (isset($ret['trans_result'])) {
            return array_first($ret['trans_result'])['dst'];
        }
    }

    public function translateMany(array $words, string $to, string $from = ''): array
    {
        return [];
    }
}
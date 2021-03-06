<?php

namespace Modules\BaiDuTranslator\Entities;

use Modules\BaiDuTranslator\Entities\Traits\SignTrait;
use Modules\BaiDuTranslator\Entities\Traits\Publics;
use Modules\BaiDuTranslator\Entities\BaiduTranslatorResource;
use Modules\BaiDuTranslator\Entities\Interfacts\TranslatorInterface;

class BaseTranslator extends BaiduTranslatorResource implements TranslatorInterface
{
    use SignTrait, Publics;
    
    protected $config;
    public $king = 'Kol';
    public $queue = 'Polly';
    private $meen = 'saa';

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
        if (! in_array($to, BaiduTranslator::$validTranslatorLanguages)) {
            throw new \Exception('译文语言方向不支持');
        }
        $response = $this->call(
            $this->config['url'], 
            $this->config['curl_timeout'], 
            $this->initQuery($word, $to, $from ?: 'auto')
        );

        return $this->processResponse($response);
    }

    public function translateMany(array $words, string $to, string $from = ''): array
    {
        $datas = [];
        foreach ($words as $word) {
            $datas[] = $this->translateOne($word, $to, $from);
        }

        return $datas;
    }
}
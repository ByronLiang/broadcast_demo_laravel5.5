<?php

namespace Modules\BaiDuTranslator\Entities\Interfacts;

interface TranslatorInterface
{
    public function translateOne(string $word, string $to, string $from = ''): string;

    public function translateMany(array $words, string $to, string $from = ''): array;
}
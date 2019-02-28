<?php

namespace Modules\BaiDuTranslator\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\BaiDuTranslator\Entities\BaiduTranslator;

class SingleWordTranslatorTest extends TestCase
{
    public function testExample()
    {
        $word = 'food';
        $translator = BaiduTranslator::getInstance();
        $translator_word = $translator->BaseTranslator()
            ->translateOne($word, 'zh');
        dd($translator_word);
        $this->assertTrue(true);
    }
}

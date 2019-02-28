<?php

namespace Modules\BaiDuTranslator\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\BaiDuTranslator\Entities\BaiduTranslator;

class MultipeWordTranslatorTest extends TestCase
{
    public function testExample()
    {
        $words = [
            'We love Chinese food', 
            'I Love GuangZhou', 
            'We need Courage',
        ];
        $translator = BaiduTranslator::getInstance();
        $translator_words = $translator->BaseTranslator()
            ->translateMany($words, 'zh');
        dd($translator_words);
        $this->assertTrue(true);
    }
}

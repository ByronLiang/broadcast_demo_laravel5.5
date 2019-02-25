<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\BaiDuTrans\Entities\BaiduTranslator;

class TransController extends Controller
{
    public function index()
    {
        $words = [
            'apple',
            'pencile',
            'football',
        ];
        $trans = BaiduTranslator::getInstance();
        $b = $trans->BaseTranslator();
        dd($b->translateMany($words, 'zh'));
    }
}

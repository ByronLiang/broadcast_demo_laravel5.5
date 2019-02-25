<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\BaiDuTrans\Entities\BaiduTranslator;

class TransController extends Controller
{
    public function index()
    {
        $trans = BaiduTranslator::getInstance();
        $b = $trans->BaseTranslator();
        dd($b->translateOne('apple', 'zh'));
    }
}

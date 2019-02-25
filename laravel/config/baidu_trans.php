<?php

return [
    'name' => 'BaiDuTrans',
    'curl_timeout' => env('BAIDU_TRANS_CURL_TIMEOUT', 10),
    'app_id' => env('BAIDU_TRANS_APP_ID', ''),
    'app_secret' => env('BAIDU_TRANS_SEC_KEY', ''),
];

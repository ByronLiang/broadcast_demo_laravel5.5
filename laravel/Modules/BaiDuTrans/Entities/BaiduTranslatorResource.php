<?php

namespace Modules\BaiDuTrans\Entities;

abstract class BaiduTranslatorResource
{
    function call($url, $timeout = 10, $args=null, $method="post", $testflag = 0, $headers=array())
    {
        $ret = false;
        $i = 0; 
        while($ret === false) {
            if($i > 1)
                break;
            if($i > 0) {
                sleep(1);
            }
            $ret = $this->callOnce($url, $args, $method, false, $timeout, $headers);
            $i++;
        }

        return $ret;
    }

    protected function callOnce($url, $args=null, $method="post", $withCookie = false, $timeout = CURL_TIMEOUT, $headers=array())
    {
        $ch = curl_init();
        if($method == "post") {
            $data = $this->convert($args);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST, 1);
        } else {
            $data = $this->convert($args);
            if($data) {
                if(stripos($url, "?") > 0) {
                    $url .= "&$data";
                } else {
                    $url .= "?$data";
                }
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if($withCookie) {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $_COOKIE);
        }
        $r = curl_exec($ch);
        curl_close($ch);

        return $r;
    }

    protected function convert(&$args)
    {
        $data = '';
        if (is_array($args)) {
            foreach ($args as $key=>$val) {
                if (is_array($val)) {
                    foreach ($val as $k=>$v) {
                        $data .= $key.'['.$k.']='.rawurlencode($v).'&';
                    }
                } else {
                    $data .="$key=".rawurlencode($val)."&";
                }
            }
            return trim($data, "&");
        }

        return $args;
    }

    public function processResponse($response, $key = '')
    {
        if (! is_string($response)) {
            return new \Exception('响应数据不是为json格式');
        }
        $data = json_decode($response, true);
        switch ($key) {
            case 'all':
                return $data; 
            default:
                if (isset($data['trans_result']) && count($data['trans_result']) > 0) {
                    return isset(array_first($data['trans_result'])['dst']) ?
                        array_first($data['trans_result'])['dst'] : '';
                } else {
                    return new \Exception('获取翻译结果出错');
                }
        }

    }
}
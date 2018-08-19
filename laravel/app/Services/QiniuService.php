<?php

namespace App\Services;

use Log;
use Config;
use GuzzleHttp\Client;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Processing\PersistentFop;

class QiniuService
{
    private $accessKey;
    private $secretKey;
    private $bucket;
    private $domain;
    private $uploadUrl;

    public function __construct()
    {
        $qiniu = Config::get('filesystems.disks.qiniu');
        $this->accessKey = $qiniu['access_key'];
        $this->secretKey = $qiniu['secret_key'];
        $this->bucket = $qiniu['bucket'];
        $this->domain = $qiniu['domain'];
        $this->uploadUrl = $qiniu['upload_url'];
    }

    public function getToken()
    {
        $auth = new Auth($this->accessKey, $this->secretKey);
        $token = $auth->uploadToken($this->bucket, null, 60 * 60);
        $domain = $this->domain;
        $upload_url = $this->uploadUrl;

        return compact('token', 'domain', 'upload_url');
    }

    public function uploadUrl($url)
    {
        $client = new Client(['timeout' => 120]);
        $response = $client->get($url);
        $token = $this->getToken()['token'];
        $uploader = new UploadManager();
        $result = $uploader->put($token, null, $response->getBody());
        if ($result[1]) {
            Log::error('QiniuService upload url error, url: '.$url.', '.$result[1]);
        }

        return $result[0]['key'];
    }

    public function upload($file)
    {
        $token = $this->getToken()['token'];
        $uploader = new UploadManager();
        $result = $uploader->putFile($token, null, $file);
        if ($result[1]) {
            Log::error('QiniuService upload error, '.$result[1]);
        }

        return $result[0]['key'];
    }

    // 获取音频与视频信息
    public function getMedialInfo($url)
    {
        $client = new Client();
        $res = $client->request('GET', $url);
        $code = $res->getStatusCode();
        $body = $res->getBody();
        if ($code == 200) {
            $info = json_decode($body);
            $pack['duration'] = explode('.', $info->format->duration)[0];
            $pack['size'] = $info->format->size;
            $pack['status'] = true;
        } else {
            $pack=[
                'duration' => '',
                'size' => '',
                'status' => false,
            ];
        }

        return $pack;
    }

    public function fetchCutMedial($medialKey)
    {
        $auth = new Auth($this->accessKey, $this->secretKey);
        $bucket = $this->bucket;
        $key = $medialKey;
        //队列名称，使用独立队列可以加快处理速度
        $pipeline = 'byron_line';
        // 切割文件名，生成试听文件的命名
        $medialArray = explode('.', $key);
        $sampleName = 'sample_' . current($medialArray);
        $ext = end($medialArray);
        $savedkey = $sampleName. "." .$ext;
        $entry = \Qiniu\base64_urlSafeEncode("$bucket:$savedkey");
        $fops = "avthumb/" . $ext . "/ss/0/t/60|saveas/$entry";
        $pfop = new PersistentFop($auth);
        list($id, $err) = $pfop->execute($bucket, $key, $fops, $pipeline);
        if (! $err) {
            list($res, $status) = $pfop->status($id);
            if (! $status) {
                return $res;
            } else {
                return $status;
            }
        } else {
            return $err;
        }
    }

    // 获取截取的文件的处理信息
    public function getCutMedia($id)
    {
        $auth = new Auth($this->accessKey, $this->secretKey);
        $pfop = new PersistentFop($auth);
        list($res, $status) = $pfop->status($id);

        return [$res, $status];
    }
}

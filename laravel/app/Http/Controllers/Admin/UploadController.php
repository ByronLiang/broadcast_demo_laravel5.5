<?php

namespace App\Http\Controllers\Admin;

use JSend;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    private $path;

    public function __construct()
    {
        $this->path = public_path('files');
    }

    public function postUpload(Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            $name = $file->getClientOriginalName();
            $target = explode('.', $name);
            if (is_array($target)) {
                $ext = end($target);
            } else {
                $ext = $file->guessClientExtension();
            }
            $name = bin2hex(random_bytes(5)).'-'.time().'.'.$ext;
            $file->move($this->path, $name);
            $fullPath = '/files/' . $name;

            return JSend::success(['file' => $fullPath]);
            // return JSend::success(['file' => $name, 'path' => '/files/']);
        }

        return JSend::error();
    }

    public function postUploadProcess(Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            $name = $file->getClientOriginalName();
            $target = explode('.', $name);
            if (is_array($target)) {
                $ext = end($target);
            } else {
                $ext = $file->guessClientExtension();
            }
            if (in_array($ext, ['rar', 'zip'])) {
                \Log::info('start upload');
                $name = bin2hex(random_bytes(5)).'-'.time().'.'.$ext;
                $file->move($this->path, $name);
                $fullPath = '/files/' . $name;
                $zipFile = $this->path . '/' . $name;
                $targetFile = $this->path . '/files/unzip/';
                // $this->get_zip_originalsize($zipFile, $targetFile);
                \Log::info('read zip');

                return JSend::success(['file' => $fullPath]);
            }
        }

        return JSend::error();
    }

    // 上传资源到本地，作为合成gif的资源
    public function postCreateGif(Request $request)
    {
        $targetFile = storage_path('app/create_gif_resource');
        $file = $request->file('file');
        if ($file) {
            $ext = $file->guessClientExtension();
            $name = bin2hex(random_bytes(5)).'-'.time().'.'.$ext;
            $file->move($targetFile, $name);
            $fullPath = $targetFile . '/' . $name;

            return JSend::success(['file' => $fullPath]);
        }

        return JSend::error();
    }

    public function getCheckZip()
    {
        $zipFile = $this->path . '/bfff61df97-1532235186.zip';
        $res = file_exists($zipFile);
        // $targetFile = $this->path . '/unzip/';
        $targetFile = storage_path('app/unzip') . '/';
        $this->get_zip_originalsize($zipFile, $targetFile);

        return JSend::success(compact('res', 'fileName', 'zip', 'targetFile'));
    }

    protected function get_zip_originalsize($filename, $path)
    {
        //先判断待解压的文件是否存在
        if(! file_exists($filename)){
            die("文件 $filename 不存在！");
        }
        //打开压缩包
        $resource = zip_open($filename);
        //遍历读取压缩包里面的一个个文件
        while ($dir_resource = zip_read($resource)) {
            //如果能打开则继续
            if (zip_entry_open($resource,$dir_resource)) {
                \Log::info('chapterName: ' . zip_entry_name($dir_resource));
                //获取当前项目的名称,即压缩包里面当前对应的文件名
                $file_name = $path.zip_entry_name($dir_resource);
                \Log::info('full target: ' . $file_name);
                //以最后一个“/”分割,再用字符串截取出路径部分
                $file_path = substr($file_name,0,strrpos($file_name, "/"));
                \Log::info('last file path: ' . $file_path);
                //如果路径不存在，则创建一个目录，true表示可以创建多级目录
                if(!is_dir($file_path)){
                    mkdir($file_path,0777,true);
                }
                //如果不是目录，则写入文件
                if(!is_dir($file_name)) {
                    // 获取文件大小
                    $file_size = zip_entry_filesize($dir_resource);
                    \Log::info('size: ' . $file_size);
                    //读取这个文件
                    $file_content = zip_entry_read($dir_resource, $file_size);
                    file_put_contents($file_name,$file_content);
                }
                //关闭当前
                zip_entry_close($dir_resource);
            }
        }
        //关闭压缩包
        zip_close($resource);
    }
}

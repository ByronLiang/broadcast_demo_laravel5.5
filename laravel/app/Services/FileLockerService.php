<?php

namespace App\Services;

class FileLockerService
{
    protected $file;

    public function __construct()
    {
        $this->file = storage_path('certificate/alipay_test/alipay_public_key.pem');
    }
    
    public function setLockFile($wait = true)
    {
        $loc_file = fopen($this->file, 'r+');
        if (! $loc_file ) {
            throw new \Exception('Can\'t create lock file!');
        }
        if ($wait) {
            $try = 5;
            $res = $this->waitLockFile($try, $loc_file);
        }
        if ($res) {
            sleep(10);
            \Log::info('get lock file');
        }
        $this->releaseLock($loc_file);
    }

    protected function waitLockFile($try, $file)
    {
        do {
            \Log::info('trying to get the locker');
            $lock = flock($file, LOCK_EX);
            \Log::info($lock);
            if(! $lock) {
                //如果没有获取到锁，释放CPU，休息5000毫秒
                usleep(3000);
                \Log::info('trying to get the locker');
            }
        } while(! $lock && --$try >= 0);

        return $lock;
    }

    protected function releaseLock($file)
    {
        flock($file, LOCK_UN);
        fclose($file);
    }

    public function getContent()
    {
        return file_get_contents($this->file);
    }
}
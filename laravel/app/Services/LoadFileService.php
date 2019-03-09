<?php

namespace App\Services;

class LoadFileService
{
    protected $filePath;

    public function __construct($file_path)
    {
        $this->filePath = $file_path;
    }

    public function resloveFile()
    {
        $this->ensureFileIsReadable();
        $lines = $this->readLinesFromFile($this->filePath);
        
        return $this->processFilters($lines);
    }

    protected function ensureFileIsReadable()
    {
        if (!is_readable($this->filePath) || !is_file($this->filePath)) {
            throw new \Exception(sprintf('Unable to read the environment file at %s.', $this->filePath));
        }
    }

    protected function readLinesFromFile($filePath)
    {
        // Read file into an array of lines with auto-detected line endings
        $autodetect = ini_get('auto_detect_line_endings');
        ini_set('auto_detect_line_endings', '1');
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        ini_set('auto_detect_line_endings', $autodetect);

        return $lines;
    }

    protected function processFilters($lines)
    {
    	$res = [];
    	foreach ($lines as $key => $value) {
    		$str = $this->transCode($value);
    		$data = preg_split("/([0-9]+)/", $str, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    		if (is_array($data) && count($data) == 2) {
    			$res[$key]['number'] = $data[0];
    			$res[$key]['name'] = $data[1];
    		} else {
    			\Log::info('error: '. $str);
    		}
    	}

    	return $res;
    }

    protected function transCode($str)
    {
    	return iconv("gb2312", "utf-8", $str);
    }
}
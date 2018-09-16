<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\ExcelFilter\ExcelChunkReadFilter;

class ExcelService
{
    public function exportData($filename, $callback)
    {
        $file_ext = strtolower(array_last(explode('.', $filename)));
        if (!in_array($file_ext, ['xls', 'xlsx'])) {
            $file_ext = 'xlsx';
        }
        $spreadsheet = new Spreadsheet();
        // Set document properties
        $spreadsheet->getProperties()->setCreator('Maarten Balliauw')
            ->setLastModifiedBy('Maarten Balliauw')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file');
        $callback($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $writer = IOFactory::createWriter($spreadsheet, ucfirst($file_ext));

        return $writer->save('php://output');
    }

    public function test()
    {
        $a = [];
        $i = 0;
        $pack = [];
        $file_path = public_path('/upload/').'example2.xls';
        $read = IOFactory::load($file_path);
        $sheet = $read->getSheet(0);
        $row_total = $sheet->getHighestRow();
        $inputFileName = 'Xls';
        $chunkSize = 20;
        // $number = intval($row_total / $chunkSize);
        // $round = $row_total % $chunkSize;
        $reader = IOFactory::createReader($inputFileName);
        $reader->setReadDataOnly(true);
        for ($startRow = 2; $startRow <= $row_total; $startRow += $chunkSize) {
            $chunkFilter = new ExcelChunkReadFilter($startRow, $chunkSize);
            $reader->setReadFilter($chunkFilter);
            $spreadsheet = $reader->load($file_path);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, false, false);
            // 移除被忽略的行数，只提取数据项
            $pack = array_splice($sheetData, $i * $chunkSize + 1, $chunkSize);
            $a[$i] = [
                'row' => $startRow,
                'data' => $pack,
                'row_total' => $row_total,
                'last_row' => $startRow + $chunkSize,
            ];
            $pack = [];
            // $a[$i] = [
            //     'row' => $startRow,
            //     'data' => $sheetData,
            //     'row_total' => $row_total,
            //     'last_row' => $startRow + $chunkSize,
            // ];
            $i ++;
            $spreadsheet->disconnectWorksheets();
        }
        dd($a);
    }
}

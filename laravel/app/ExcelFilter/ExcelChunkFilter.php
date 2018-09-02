<?php

namespace App\ExcelFilter;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ExcelChunkReadFilter implements IReadFilter
{
    private $startRow = 0;
    private $endRow = 0;

    public function __construct($startRow, $chunkSize)
    {
        $this->startRow = $startRow;
        $this->endRow = $startRow + $chunkSize;
    }

    public function readCell($column, $row, $worksheetName = '')
    {
        if (($row > 1) && ($row >= $this->startRow && $row < $this->endRow)) {
            // 纵向列的筛选
            // if (in_array($column, range('A', 'B'))) {
                return true;
            // }
        }

        return false;
    }
}

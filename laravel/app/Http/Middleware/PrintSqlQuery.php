<?php

namespace App\Http\Middleware;

use DB;
use Log;
use Closure;
use Carbon\Carbon;

class PrintSqlQuery
{
    private $printSqlLogEnv;

    public function handle($request, Closure $next)
    {
        $this->printSqlLogEnv = $printSqlLog = env('PRINT_SQL_LOG');

        if ($printSqlLog === true
            || $printSqlLog === 'stderr'
            || $printSqlLog === 'log'
        ) {
            DB::connection()->enableQueryLog();
            DB::connection()->flushQueryLog();
        }

        $response = $next($request);

        if ($printSqlLog === true
            || $printSqlLog === 'stderr'
            || $printSqlLog === 'log'
        ) {
            $this->printSqlLog($request);
        }

        return $response;
    }

    private function queryValueToString($val)
    {
        if ($val instanceof Carbon) {
            $val = (string) $val;
        }
        if (is_string($val)) {
            return "'{$val}'";
        } elseif (is_bool($val)) {
            return (string) (int) $val;
        } else {
            return (string) $val;
        }
    }

    private function printSqlLog($request)
    {
        $path = $request->path();
        $queries = DB::getQueryLog();
        $time = 0;
        foreach ($queries as $key => $query) {
            $sql = $query['query'];
            foreach ($query['bindings'] as $val) {
                $sql = preg_replace('/\?/', $this->queryValueToString($val), $sql, 1);
            }
            $time += $query['time'];
            $info = '['.($key + 1).']['.$path.'] '.$sql.' ['.$query['time'].'ms]';

            $this->writeLog($info);
        }
        $total = '['.$path.'] total time '.$time.'ms';
        $this->writeLog($total);
    }

    private function writeLog($log)
    {
        if ($this->printSqlLogEnv === true || $this->printSqlLogEnv === 'stderr') {
            error_log($log);
        }
        if ($this->printSqlLogEnv === true || $this->printSqlLogEnv === 'log') {
            $file = new \SplFileObject(storage_path('logs/sql_'.date('Y-m-d').'.log'), 'a');
            $file->fwrite($log."\n");
        }
    }
}

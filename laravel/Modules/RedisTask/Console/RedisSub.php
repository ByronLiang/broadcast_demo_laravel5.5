<?php

namespace Modules\RedisTask\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Redis;

class RedisSub extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'redis:sub {channel}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'subscribe the redis channel publish';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (! $this->argument('channel')) {
            return $this->warn('请设置订阅的频道名称');
        } else {
            Redis::subscribe([$this->argument('channel')], function ($message) {
                return $this->info($message);
            });
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Contract\RedisKey;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $code = decrypt("eyJpdiI6IlZKdDFLbDJZTGsrdG1MNW4wOHFUbnc9PSIsInZhbHVlIjoiSlRyUXh5YWd3WkR3bXVENk5kdFRVbFJKVXZcL2tnejA2NHZpWm9yeDd4TzhOUHY3clptZDVCb3ZPRE12QjFFbG0iLCJtYWMiOiI0MGFmZTFhMTUzNDAwNjMxNWU0ODQxYWZjODcxZDQyMDVmZDQwMzJiOGU0ODc2ZmRmODNjNjlmNTI4ZjIyMmFlIn0=");

        $key = sprintf(RedisKey::USER_WXCODE_OPENID,$code);
        $openidCache = Cache::get($key);
        $openid = decrypt($openidCache);
        dump($openid);
    }
}

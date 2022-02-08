<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'data will be change every day';

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
     * @return int
     */
    public function handle()
    {
        $words = DB::table('words')->where('created_at', '<', Carbon::now()->subMinutes(60))->get();
        // foreach ($words as $word) {
        //     $x = $word->content;
        //     $y = $word->author;
        //     $z = $x . '-' .$y;
        //     Log::info($z);
        // }
            Log::info($words);
    }
}

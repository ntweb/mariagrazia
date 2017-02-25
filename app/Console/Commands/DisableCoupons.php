<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DisableCoupons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable old coupons';

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
        DB::table('lab_coupons')
                ->where('end', '<', date('Y-m-d'))
                ->where('active', '=', '1')
                ->update(['active' => '0']);
    }
}

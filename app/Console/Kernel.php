<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DisableCoupons::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         // impostare cron * * * * * /usr/local/bin/php -c /usr/local/apache/conf/userdata/std/2/vujcgrei/php.ini /home/vujcgrei/artisan schedule:run > /dev/null 2>&1

        $schedule->command('coupon:disable')->everyFiveMinutes();
        $schedule->command('queue:work')->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

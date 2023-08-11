<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $middleware = [
        // ...
        \App\Http\Middleware\LogRequestMiddleware::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        //默认情况下，将获取超过 24 小时的所有数据。在调用命令时可以使用 hours 选项来确定保留 Telescope 数据的时间。例如，以下命令将删除 48 小时前创建的所有记录：
        $schedule->command('telescope:prune --hours=168')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('reports:defib-inspection --queued')->sundays()->at('09:00');
        $schedule->command('reports:battery-expiry --queued')->monthlyOn(1, '09:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

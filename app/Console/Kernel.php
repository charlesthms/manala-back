<?php

namespace App\Console;

use App\Http\Controllers\Cron\GenerateInvoicesController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  /**
   * Define the application's command schedule.
   */
  protected function schedule(Schedule $schedule): void
  {
    // $schedule->command('inspire')->hourly();

    $schedule->call('App\Http\Controllers\Cron\GenerateInvoicesController@index')->monthlyOn(1, '08:10');
    $schedule->call('App\Http\Controllers\Cron\SendInvoicesController@sendInvoices')->monthlyOn(1, '08:00');

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

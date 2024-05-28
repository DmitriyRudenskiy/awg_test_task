<?php

namespace App\Console\Commands;

use App\Services\CurrencyService;
use Illuminate\Console\Command;

class CurrencySynchronizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:synchronize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize currency in current day';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(CurrencyService $service)
    {
        $service->sync();
    }
}

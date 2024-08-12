<?php

namespace App\Console\Commands;

use App\Services\FetchExchangeRateService;
use Illuminate\Console\Command;

class FetchExchangeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-exchange-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch currency exchange rates from Latvia Bank API';

    /**
     * Execute the console command.
     */
    public function handle(FetchExchangeRateService $fetchExchangeRateService): int
    {
        try {
            $fetchExchangeRateService->execute();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
        return 0;
    }
}

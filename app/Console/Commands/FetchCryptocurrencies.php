<?php

namespace App\Console\Commands;

use App\Services\FetchCryptocurrenciesService;
use Illuminate\Console\Command;

class FetchCryptocurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-cryptocurrencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch cryptocurrency data from an api';

    /**
     * Execute the console command.
     */
    public function handle(FetchCryptocurrenciesService $fetchCryptocurrenciesService): int
    {
        try {
            $fetchCryptocurrenciesService->execute();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
        return 0;
    }
}

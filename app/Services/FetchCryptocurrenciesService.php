<?php

namespace App\Services;

use App\Models\Cryptocurrency;
use Illuminate\Support\Facades\Http;

class FetchCryptocurrenciesService
{
    private const COINMARKETCAP_API_URL = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
    private const COINPAPRIKA_API_URL = 'https://api.coinpaprika.com/v1/tickers';
    private const DEFAULT_CRYPTOCURRENCY_LIMIT = 100;

    public function execute(): void
    {
        $apiKey = env('CMC_API_KEY');
        $cryptocurrencies = $this->fetchCryptocurrencies($apiKey);

        foreach ($cryptocurrencies as $crypto) {
            $this->updateOrCreateCryptocurrency($crypto);
        }
    }

    private function fetchCryptocurrencies(?string $apiKey): array
    {
        if ($apiKey) {
            $response = Http::get(self::COINMARKETCAP_API_URL, ['CMC_PRO_API_KEY' => $apiKey])->body();
            $cryptocurrencies = json_decode($response);
            return $cryptocurrencies->data ?? [];
        }

        $response = Http::get(self::COINPAPRIKA_API_URL)->body();
        $cryptocurrencies = json_decode($response);

        return array_slice($cryptocurrencies, 0, self::DEFAULT_CRYPTOCURRENCY_LIMIT);
    }


    private function updateOrCreateCryptocurrency($crypto): void
    {
        $price = rtrim(sprintf('%.18f', $crypto->quote->USD->price ?? $crypto->quotes->USD->price), '0');
        $percentChange24h = $crypto->quote->USD->percent_change_24h ?? $crypto->quotes->USD->percent_change_24h;

        Cryptocurrency::updateOrCreate(
            ['name' => $crypto->name, 'symbol' => $crypto->symbol],
            ['price' => $price, 'percent_change_24h' => $percentChange24h]
        );
    }
}

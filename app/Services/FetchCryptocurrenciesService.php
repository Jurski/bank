<?php

namespace App\Services;

use App\Models\Cryptocurrency;
use Illuminate\Support\Facades\Http;

class FetchCryptocurrenciesService
{
    public function execute(): void
    {
        $apiLink = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?CMC_PRO_API_KEY=' . env('CMC_API_KEY');
        $response = Http::get($apiLink)->body();

        $cryptocurrencies = json_decode($response);

        foreach ($cryptocurrencies->data as $crypto) {
            $stringPrice = rtrim(sprintf('%.18f', $crypto->quote->USD->price), '0');

            Cryptocurrency::updateOrCreate(
                ['name' => $crypto->name, 'symbol' => $crypto->symbol],
                ['price' => $stringPrice, 'percent_change_24h' => $crypto->quote->USD->percent_change_24h]
            );
        }
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FetchExchangeRateService {
    public function execute(): void {
        $responseBody = Http::get('https://www.bank.lv/vk/ecb.xml')->body();
        $currencies = simplexml_load_string($responseBody);

        foreach($currencies->Currencies->Currency as $currency) {
            $symbol = (string)$currency->ID;
            $rate = (float)$currency->Rate;

            $intRate = intval($rate*10000);

            Cache::put($symbol, $intRate, now()->addDay());
        }
    }
}

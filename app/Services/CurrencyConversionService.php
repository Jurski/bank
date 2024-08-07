<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CurrencyConversionService
{
    public function convert(float $amount, string $senderCurrency, string $receiverCurrency): int
    {
        $receiverRate = Cache::get($receiverCurrency) / 10000;
        $senderRate = Cache::get($senderCurrency) / 10000;
        $scaledSenderAmount = $amount * 10000;

        if($senderCurrency === 'EUR') {
            $convertedAmount = $scaledSenderAmount * $receiverRate;
        } else {
            $sendInEur = $scaledSenderAmount / $senderRate;
            $convertedAmount = $sendInEur * $receiverRate;
        }

        $roundedAmount = round($convertedAmount);
        $roundedAmountInCents = $roundedAmount / 100;

        return (int) $roundedAmountInCents;
    }
}

<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Cryptocurrency;
use App\Models\CryptocurrencyHolding;
use App\Models\CryptocurrencyPurchase;
use App\Models\CryptocurrencyTransaction;
use Illuminate\Support\Facades\DB;

class CryptocurrencyService
{
    public function buy(int $accountId, string $usdAmount, Cryptocurrency $cryptocurrency): void
    {
        DB::transaction(function () use ($accountId, $usdAmount, $cryptocurrency) {
            $account = Account::findOrFail($accountId);

            $usdAmountInCents = (int)bcmul($usdAmount, '100', 2);
            $account->balance -= $usdAmountInCents;
            $account->save();

            $cryptocurrencyPrice = Cryptocurrency::find($cryptocurrency->id)->price;
            $cryptocurrencyPriceInCents = bcmul($cryptocurrencyPrice, '100', 18);
            $quantity = bcdiv($usdAmountInCents, $cryptocurrencyPriceInCents, 18);

            CryptocurrencyPurchase::create([
                'account_id' => $accountId,
                'symbol' => $cryptocurrency->symbol,
                'quantity' => $quantity,
                'purchase_price' => $cryptocurrencyPrice,
            ]);

            CryptocurrencyTransaction::create([
                'account_id' => $accountId,
                'symbol' => $cryptocurrency->symbol,
                'type' => 'buy',
                'quantity' => $quantity,
                'purchase_price' => $cryptocurrencyPrice,
            ]);

            $holding = CryptocurrencyHolding::firstOrNew(
                ['account_id' => $accountId, 'symbol' => $cryptocurrency->symbol]
            );

            $newTotalQuantity = bcadd($holding->quantity ?? '0', $quantity, 18);

            $existingTotalCost = bcmul($holding->quantity ?? '0', $holding->average_purchase_price ?? '0', 18);

            $newPurchaseCost = bcmul($quantity, $cryptocurrencyPrice, 18);

            $newTotalCost = bcadd($existingTotalCost, $newPurchaseCost, 18);

            $newAveragePurchasePrice = bcdiv($newTotalCost, $newTotalQuantity, 18);

            $holding->quantity = $newTotalQuantity;
            $holding->average_purchase_price = $newAveragePurchasePrice;
            $holding->save();
        });
    }
}

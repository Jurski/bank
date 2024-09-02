<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class AccountService
{
    private CurrencyConversionService $currencyConverter;

    public function __construct(CurrencyConversionService $currencyConversionService)
    {
        $this->currencyConverter = $currencyConversionService;
    }

    public function transfer(int $senderId, string $receiverAccountNumber, float $amount): void
    {
        DB::transaction(function () use ($senderId, $receiverAccountNumber, $amount) {
            $sender = Account::findOrFail($senderId);
            $receiver = Account::where('account_number', $receiverAccountNumber)->firstOrFail();

            $senderCurrency = $sender->currency;
            $receiverCurrency = $receiver->currency;

            if ($senderCurrency !== $receiverCurrency) {
                $convertedAmount = $this->currencyConverter->convert($amount, $senderCurrency, $receiverCurrency);

                $sender->balance -= $amount * 100;
                $receiver->balance += $convertedAmount;

            } else {
                $sender->balance -= $amount * 100;
                $receiver->balance += $amount * 100;
            }

            $sender->save();
            $receiver->save();

            $transaction = Transaction::create([
                'base_currency' => $senderCurrency,
                'amount' => $amount * 100,
                'converted_currency' => $senderCurrency !== $receiverCurrency ? $receiverCurrency : null,
                'converted_amount' => $senderCurrency !== $receiverCurrency ? $convertedAmount : null,
            ]);

            $transaction->accounts()->attach($sender->id, ['type' => 'sender']);
            $transaction->accounts()->attach($receiver->id, ['type' => 'receiver']);
        });
    }
}

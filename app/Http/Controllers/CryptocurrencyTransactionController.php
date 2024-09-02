<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCryptocurrencyTransactionRequest;
use App\Models\Account;
use App\Models\Cryptocurrency;
use App\Services\CryptocurrencyService;
use Illuminate\Http\RedirectResponse;

class CryptocurrencyTransactionController extends Controller
{
    private CryptocurrencyService $cryptocurrencyService;

    public function __construct(CryptocurrencyService $cryptocurrencyService)
    {
        $this->cryptocurrencyService = $cryptocurrencyService;
    }

    public function store(StoreCryptocurrencyTransactionRequest $request, Cryptocurrency $cryptocurrency): RedirectResponse
    {
        $accountId = $request->input('account');
        $account = Account::findOrFail($accountId);
        $user = auth()->user();

        if (
            $user->id !== $account->user_id ||
            $account->type !== 'investment'
        ) {
            abort(403);
        }

        $this->cryptocurrencyService->buy($accountId, $request->input('amount'), $cryptocurrency);

        return redirect('cryptocurrencies');
    }
}

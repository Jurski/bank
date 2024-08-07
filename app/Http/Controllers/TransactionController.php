<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function create(): View
    {
        $accounts = Account::where('user_id', auth()->id())->get(); // TODO:: also method on model? and then call it on line below?
        return view('accounts.transfer', ['accounts' => $accounts]);
    }

    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $this->accountService->transfer($request->sender, $request->receiver, $request->amount);
        return redirect('/accounts'); // TODO transfer to the transaction made?
    }
}

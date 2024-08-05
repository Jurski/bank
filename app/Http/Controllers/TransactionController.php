<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function create(): View
    {
        $accounts = Account::where('user_id', auth()->id())->get(); // TODO:: also method on model? and then call it on line below?
        return view('accounts.transfer', ['accounts' => $accounts]);
    }

    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        // TODO:: Convertation for different currencies
        // TODO:: Create transaction model and store it in DB
        DB::transaction(function () use ($request) {
            $fromAccount = Account::findOrFail($request->sender); // TODO:: create findAccount on model
            $toAccount = Account::where('account_number', $request->receiver)->firstOrFail();

            $fromAccount->amount -= $request->amount; // TODO:: create single method on model for this
            $toAccount->amount += $request->amount;

            $fromAccount->save();
            $toAccount->save();
        });

        return redirect('/accounts');
    }
}

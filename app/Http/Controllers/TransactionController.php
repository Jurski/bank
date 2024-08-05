<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
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
        // TODO:: refactor DB:transaction into service? also try catch and research transaction begin?
        DB::transaction(function () use ($request) {
            $sender = Account::findOrFail($request->sender); // TODO:: create findAccount on model
            $receiver = Account::where('account_number', $request->receiver)->firstOrFail();

            $sender->balance -= $request->amount * 100; // TODO:: create single method on model for this
            $receiver->balance += $request->amount * 100;

            $sender->save();
            $receiver->save();

            $transaction = Transaction::create(['amount' => $request->amount]);

            $transaction->accounts()->attach($sender->id, ['type' => 'sender']);
            $transaction->accounts()->attach($receiver->id, ['type' => 'receiver']);
        });

        return redirect('/accounts');
    }
}

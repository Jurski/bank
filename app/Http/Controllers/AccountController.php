<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function create(): View
    {
        return view('accounts.create', ['currencies' => Config::get("currencies")]);
    }

    public function store(StoreAccountRequest $request): RedirectResponse
    {
        $account = Account::create([
            'user_id' => auth()->id(),
            'account_number' => (string)Str::uuid(),
            'type' => $request->type,
            'currency' => $request->currency
        ]);

        return redirect('/accounts');
    }

    public function index(): View
    {
        $accounts = Account::all()->where('user_id', auth()->id());
        return view('accounts.index', ['accounts' => $accounts]);
    }

    public function show(Account $account): View
    { // TODO:: inline gate and define it in appserviceprovider
        return view('accounts.show', ['account' => $account]);
    }
}

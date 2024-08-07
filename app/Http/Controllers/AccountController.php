<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
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
        $accounts = Account::where('user_id', auth()->id())->get(); // TODO:: needs to be without all for optimization
        return view('accounts.index', ['accounts' => $accounts]);
    }

    public function show(int $id): View
    { // TODO:: inline gate and define it in appserviceprovider
        $account = Account::with('transactions')->findOrFail($id); // TODO:: paginate for transactions??

        return view('accounts.show', ['account' => $account]);
    }
}

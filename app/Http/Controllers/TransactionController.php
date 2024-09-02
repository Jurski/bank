<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransactionController extends Controller
{
    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index(): View
    {
        $userTransactions = DB::table('transactions')
            ->join('accounts', 'account_transaction.account_id', '=', 'accounts.id')
            ->join('account_transaction', 'transactions.id', '=', 'account_transaction.transaction_id')
            ->where('accounts.user_id', auth()->id());

        return view('transactions.index', ['transactions' => $userTransactions->paginate(5)]);
    }

    public function create(): View
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        return view('accounts.transfer', ['accounts' => $accounts]);
    }

    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $accountId = $request->input('sender');
        $account = Account::findOrFail($accountId);
        $user = auth()->user();

        if ($user->id !== $account->user_id) {
            abort(403);
        }

        $this->accountService->transfer($request->sender, $request->receiver, $request->amount);
        return redirect('/accounts/' . $accountId);
    }
}

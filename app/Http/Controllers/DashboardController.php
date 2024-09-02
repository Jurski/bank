<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $holdings = $user->accounts()->with('cryptocurrencyHoldings')->get()->pluck('cryptocurrencyHoldings')->flatten();
        $symbols = $holdings->pluck('symbol')->unique();

        $cryptocurrencyPrices = DB::table('cryptocurrencies')
            ->whereIn('symbol', $symbols)
            ->pluck('price', 'symbol');

        $cryptocurrencyTransactions = $user->accounts()->with('cryptocurrencyTransactions')->get()->pluck('cryptocurrencyTransactions')->flatten();

        return view('dashboard', [
            'holdings' => $holdings,
            'cryptocurrencyPrices' => $cryptocurrencyPrices,
            'cryptocurrencyTransactions' => $cryptocurrencyTransactions
        ]);
    }
}

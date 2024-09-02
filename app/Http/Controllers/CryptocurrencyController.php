<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;
use Illuminate\View\View;

class CryptocurrencyController extends Controller
{
    public function index(): View
    {
        $cryptocurrencies = Cryptocurrency::all();
        return view('cryptocurrencies.index', ['cryptocurrencies' => $cryptocurrencies]);
    }

    public function show(Cryptocurrency $cryptocurrency): View
    {
        $investmentAccounts = auth()->user()->accounts->where('type', 'investment');
        return view('cryptocurrencies.show', ['cryptocurrency' => $cryptocurrency, 'investmentAccounts' => $investmentAccounts]);
    }
}

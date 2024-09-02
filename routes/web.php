<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CryptocurrencyController;
use App\Http\Controllers\CryptocurrencyTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/accounts/create', [AccountController::class, 'create'])->name('account.create')->middleware('auth');
Route::post('/accounts', [AccountController::class, 'store'])->middleware('auth');
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/accounts/transfer', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/bank/transactions', [TransactionController::class, 'store']);
    Route::get('/bank/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/accounts/{account}', [AccountController::class, 'show'])->can('view', 'account')->name('accounts.show');
});

Route::get('/cryptocurrencies', [CryptocurrencyController::class, 'index'])->name('cryptocurrencies.index')->middleware('auth');
Route::get('/cryptocurrencies/{cryptocurrency}', [CryptocurrencyController::class, 'show'])->name('cryptocurrencies.show')->middleware('auth');
Route::post('/cryptocurrencies/buy/{cryptocurrency}', [CryptocurrencyTransactionController::class, 'store'])->middleware('auth');


require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

//Route::get('/test', function() {
//    $acc = \App\Models\Account::where('account_number', '17bbc4c7-0404-4446-8597-c380bc8e5460')->first();
//    return gettype($acc->amount);
//});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/accounts/create', [AccountController::class, 'create'])->middleware('auth'); // TODO:: refactor to named routes + adjustments in blade then
Route::post('/accounts', [AccountController::class, 'store'])->middleware('auth'); // TODO:: refactor to named routes + adjustments in blade then
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/accounts/transfer', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/accounts/{account}', [AccountController::class, 'show'])->name('accounts.show');
});


require __DIR__ . '/auth.php';

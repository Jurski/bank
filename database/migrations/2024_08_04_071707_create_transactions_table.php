<?php

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('base_currency');
            $table->integer('amount');
            $table->string('converted_currency')->nullable();
            $table->integer('converted_amount')->nullable();
            $table->timestamps();
        });

        Schema::create('account_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Account::class);
            $table->foreignIdFor(Transaction::class);
            $table->enum('type', ['sender', 'receiver']);
            $table->unique(['account_id', 'transaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('account_transaction');
    }
};

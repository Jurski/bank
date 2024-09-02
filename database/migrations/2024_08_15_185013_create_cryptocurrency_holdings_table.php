<?php

use App\Models\Account;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cryptocurrency_holdings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Account::class);
            $table->string('symbol');
            $table->string('quantity');
            $table->string('average_purchase_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cryptocurrency_holdings');
    }
};

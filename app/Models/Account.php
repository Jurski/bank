<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class)
            ->using(CustomPivot::class,)
            ->withPivot('type');
    }

    public function cryptocurrencyPurchases(): hasMany
    {
        return $this->hasMany(CryptocurrencyPurchase::class);
    }

    public function cryptocurrencyTransactions(): hasMany
    {
        return $this->hasMany(CryptocurrencyTransaction::class);
    }

    public function cryptocurrencyHoldings(): hasMany
    {
        return $this->hasMany(CryptocurrencyHolding::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class)
            ->using(CustomPivot::class,)
            ->withPivot('type');
    }
}

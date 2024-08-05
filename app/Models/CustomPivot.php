<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomPivot extends Pivot
{
    public $timestamps = false;

    protected $fillable = ['type'];
}

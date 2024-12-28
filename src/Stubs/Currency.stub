<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    // Define the table associated with the model
    protected $table = 'currencies';

    // Define the fillable attributes
    protected $fillable = ['code', 'sell_rate', 'buy_rate'];

    // Cast the rates to float for easy handling
    protected $casts = [
        'sell_rate' => 'float',
        'buy_rate' => 'float',
    ];

    // Add any relationships, methods, or custom logic you want here
}

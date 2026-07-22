<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'sold_at' => 'date',
            'sale_value' => 'decimal:2',
            'cash_received' => 'decimal:2',
            'has_trade' => 'boolean',
            'trade_value' => 'decimal:2',
            'balance_receivable' => 'decimal:2',
            'commission_value' => 'decimal:2',
            'payment_methods' => 'array',
            'metadata' => 'array',
        ];
    }
}

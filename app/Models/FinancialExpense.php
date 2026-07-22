<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialExpense extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'expense_date' => 'date',
            'amount' => 'decimal:2',
            'metadata' => 'array',
        ];
    }
}

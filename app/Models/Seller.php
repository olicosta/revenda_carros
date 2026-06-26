<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'commission_default' => 'decimal:2',
            'commission_percentage' => 'decimal:2',
            'metadata' => 'array',
        ];
    }
}

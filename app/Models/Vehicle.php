<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'mileage' => 'integer',
            'purchase_price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'preparation_cost' => 'decimal:2',
            'fees_cost' => 'decimal:2',
            'commission_rate' => 'decimal:2',
            'featured' => 'boolean',
            'offer' => 'boolean',
            'gallery' => 'array',
            'options' => 'array',
            'metadata' => 'array',
        ];
    }
}

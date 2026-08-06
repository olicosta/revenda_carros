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
            'manufacture_year' => 'integer',
            'model_year' => 'integer',
            'purchase_price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'preparation_cost' => 'decimal:2',
            'fees_cost' => 'decimal:2',
            'commission_rate' => 'decimal:2',
            'entry_date' => 'date',
            'available_at' => 'date',
            'reserved_at' => 'date',
            'delivered_at' => 'date',
            'completion_percentage' => 'integer',
            'featured' => 'boolean',
            'offer' => 'boolean',
            'gallery' => 'array',
            'options' => 'array',
            'metadata' => 'array',
            'documentation' => 'array',
            'condition_report' => 'array',
            'financial_details' => 'array',
            'preparation' => 'array',
            'publication' => 'array',
            'validation_status' => 'array',
        ];
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_user_id');
    }

    public function histories()
    {
        return $this->hasMany(VehicleHistory::class);
    }
}

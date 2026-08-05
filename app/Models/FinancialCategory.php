<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FinancialCategory extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'vehicle_cost' => 'boolean',
            'affects_dre' => 'boolean',
        ];
    }

    public function entries(): HasMany
    {
        return $this->hasMany(FinancialEntry::class);
    }
}

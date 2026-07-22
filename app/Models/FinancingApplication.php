<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancingApplication extends Model
{
    protected $guarded = [];

    protected $hidden = ['access_token'];

    protected function casts(): array
    {
        return [
            'requested_amount' => 'decimal:2',
            'down_payment' => 'decimal:2',
            'desired_installment' => 'decimal:2',
            'approved_amount' => 'decimal:2',
            'terms' => 'array',
            'form_data' => 'array',
            'consent_at' => 'datetime',
        ];
    }

    public function documents()
    {
        return $this->hasMany(FinancingDocument::class);
    }
}

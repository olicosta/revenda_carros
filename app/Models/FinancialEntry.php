<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FinancialEntry extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'competence_date' => 'date',
            'issued_at' => 'date',
            'due_at' => 'date',
            'settled_at' => 'date',
            'original_amount' => 'decimal:2',
            'interest_amount' => 'decimal:2',
            'fine_amount' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'final_amount' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'is_transfer' => 'boolean',
            'is_reversal' => 'boolean',
            'attachments' => 'array',
            'metadata' => 'array',
        ];
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(FinancialAccount::class, 'financial_account_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(FinancialCategory::class, 'financial_category_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(FinancialEntryPayment::class);
    }

    public function getOpenAmountAttribute(): string
    {
        return number_format(((float) $this->final_amount) - ((float) $this->paid_amount), 2, '.', '');
    }
}

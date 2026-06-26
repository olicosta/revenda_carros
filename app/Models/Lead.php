<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'next_contact_at' => 'date',
            'task_due_at' => 'datetime',
            'consent_at' => 'datetime',
            'monthly_income' => 'decimal:2',
            'metadata' => 'array',
        ];
    }

    public function communications()
    {
        return $this->hasMany(CustomerCommunication::class);
    }
}

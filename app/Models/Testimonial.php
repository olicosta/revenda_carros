<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'visible' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}

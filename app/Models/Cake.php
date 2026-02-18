<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'flavor',
        'layers',
        'price',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'layers' => 'integer',
            'price' => 'decimal:2',
            'is_available' => 'boolean',
        ];
    }
}

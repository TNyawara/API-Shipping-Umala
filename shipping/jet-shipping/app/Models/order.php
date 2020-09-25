<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'consignment',
        'origin',
        'destination',
        'weight',
        'price',
        'user_id',
        'price_per_km',
        'travel_distance',
        'expected_date'
    ];
    protected $casts = [
        'expected_date' => 'date',
    ];
    protected $appends = [
        'status',
        'payment'
    ];
}

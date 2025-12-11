<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtherPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_type',
        'driver_amount',
        'helper_amount',
        'is_active'
    ];

    protected $casts = [
        'driver_amount' => 'decimal:2',
        'helper_amount' => 'decimal:2',
        'is_active' => 'boolean'
    ];
}

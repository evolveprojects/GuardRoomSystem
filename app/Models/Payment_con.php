<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_con extends Model
{
    protected $fillable = [
        'type',
        'trip',
        'km_min',
        'km_max',
        'weight_min',
        'weight_max',
        'driver_amount',
        'driver_helper',
        'created_by',
        'updated_by',
    ];
}

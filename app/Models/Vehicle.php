<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_no',
        'type',
        'brand',
        'model',
        'color',
        'fuel_type',
        'status',
        'created_by',
        'updated_by',
    ];
}

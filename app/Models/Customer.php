<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer',
        'customers_name',
        'status',
        'type',
        'distance',
        'amount',
        'created_by',
        'updated_by',
    ];
}

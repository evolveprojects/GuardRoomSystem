<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outwardmodel_type1_t2 extends Model
{
     protected $fillable = [
        'aod_td',
        'seq_td',
        'item_se',
        'qty_se',
        'amount_se',
        'customer_se',
        'created_by',
        'updated_by',
    ];
}

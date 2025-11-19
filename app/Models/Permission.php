<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
     protected $fillable = [
        'center_id',
        'center_name',
        'status',
        'created_by',
        'updated_by',
    ];
}

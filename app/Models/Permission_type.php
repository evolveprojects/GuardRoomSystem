<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission_type extends Model
{
    //
        protected $fillable = [
       
        'type_name',
        'status',
        'created_by',
        'updated_by',
    ];
}

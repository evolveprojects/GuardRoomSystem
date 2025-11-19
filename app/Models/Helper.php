<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    protected $fillable = [
        'name',
        'epf_number',
        'email',
        'phone',
        'image'
    ];
}

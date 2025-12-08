<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutwardType2T2 extends Model
{
    use HasFactory;

    protected $table = 'outward_type2_t2';

    protected $fillable = [
        'outward_id',
        'center',
        'item',
        'quantity',
        'amount',
    ];

    public function outward()
    {
        return $this->belongsTo(\App\Models\OutwardType2::class, 'outward_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InwardItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'inward_id',
        'sr_no',
        'item_name',
        'quantity',
        'amount'
    ];

    public function inward()
    {
        return $this->belongsTo(Inward::class);
    }
}

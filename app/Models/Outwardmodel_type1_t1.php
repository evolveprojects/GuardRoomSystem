<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outwardmodel_type1_t1 extends Model
{
   protected $fillable = [
        'outward_number',
        'center',
        'vehicle_no',
        'date',
        'helper',
        'driver',
        'vehicle_type',
        'time_in',
        'time_out',
        'meter_in',
        'meter_out',
        'status',
        'type',
        'comment',
        'created_by',
        'updated_by',
    ];

    public static function generateoutno()
    {
        $lastInv = self::orderBy('id', 'desc')->first();
        if ($lastInv) {
            $lastId = intval($lastInv->id);
            $newId = $lastId + 1;
        } else {
            $newId = 1;
        }
        return 'OUT-T1-' . str_pad($newId, 5, '0', STR_PAD_LEFT);
    }
}

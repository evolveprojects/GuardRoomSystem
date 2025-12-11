<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'weight',
        'time_in',
        'time_out',
        'meter_in',
        'meter_out',
        'status',
        'type',
        'comment',
         'weight',
        'created_by',
        'updated_by',
        'inward_items',
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

    public function getInwardItemsNamesAttribute()
    {
        if (empty($this->inward_items)) {
            return [];
        }

        $ids = explode(',', $this->inward_items);

        return DB::table('other_payments')
            ->whereIn('id', $ids)
            ->pluck('payment_type')
            ->toArray();
    }

    // Usage: $item1->inward_items_names will return array of names
}

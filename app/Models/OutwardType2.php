<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OutwardType2 extends Model
{
    protected $table = 'outward_type2';

    protected $fillable = [
        'outward_no',
        'center_id',
        'type',
        'vehicle_id',
        'date',
        'driver_id',
        'helper_id',
        'vehicle_type',
        'time_in',
        'time_out',
        'meter_in',
        'meter_out',
        'comments',
        'status',
        'created_by',
        'inward_items',
    ];

    protected static function booted()
    {
        $lastInv = self::orderBy('id', 'desc')->first();
        if ($lastInv) {
            $lastId = intval($lastInv->id);
            $newId = $lastId + 1;
        } else {
            $newId = 1;
        }
        return 'OUT-' . str_pad($newId, 5, '0', STR_PAD_LEFT);
    }

    public function t2Items()
    {
        return $this->hasMany(\App\Models\OutwardType2T2::class, 'outward_id');
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
}

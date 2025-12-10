<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inward extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'inward_no',
        'center_id',
        'type',
        'date',
        'driver_id',
        'helper_id',
        'vehicle_id',
        'bill_no',
        'supplier',
        'goods_in_no',
        'to_member',
        'comments',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relationships
    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function helper()
    {
        return $this->belongsTo(Helper::class, 'helper_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(InwardItem::class, 'inward_id');
    }

    public static function generateInwardNo()
    {
        $last = self::orderBy('id', 'desc')->first();
        $newId = $last ? $last->id + 1 : 1;
        return 'IN-' . str_pad($newId, 5, '0', STR_PAD_LEFT);
    }
    // Auto-generate inward number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($inward) {
            if (empty($inward->inward_no)) {
                $inward->inward_no = self::generateInwardNo();
            }
        });
    }
}

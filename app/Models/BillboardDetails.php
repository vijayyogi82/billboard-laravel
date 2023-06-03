<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BillboardDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'billboard',
        'billboard_type',
        'owner_ref',
        'height',
        'width',
        'size',
        'latitude',
        'longitude',
        'country',
        'state',
        'provience',
        'city',
        'suburb',
        'rate_card',
        'orintation_id',
        'orintation',
        'type',
        'type_id',
        'lanlord_expiry',
        'available_start_date',
        'distance_from_road',
        'readable_distance',
        'traffic_volume',
        'added_by',
        'added_at',
        'updated_by',
        'updated_at',
    ];

    protected $table = 'billboard_details';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

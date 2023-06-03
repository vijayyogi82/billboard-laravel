<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillboardInventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'billboard',
        'month',
        'year',
        'd1',
        'd2',
        'd3',
        'd4',
        'd5',
        'd6',
        'd7',
        'd8',
        'd9',
        'd10',
        'd11',
        'd12',
        'd13',
        'd14',
        'd15',
        'd16',
        'd17',
        'd18',
        'd19',
        'd20',
        'd21',
        'd22',
        'd23',
        'd24',
        'd25',
        'd26',
        'd27',
        'd28',
        'd29',
        'd30',
        'd31',
    ];

    protected $table = 'billboard_inventories';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
            
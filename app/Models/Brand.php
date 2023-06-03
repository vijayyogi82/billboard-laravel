<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'campaign_id',
        'status',
        'added_by',
        'added_at',
        'updated_by',
        'updated_at',
    ];

    protected $table = 'brands';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

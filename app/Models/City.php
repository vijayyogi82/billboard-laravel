<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'state',
        'added_by',
        'added_at',
        'updated_by',
        'updated_at',
    ];

    protected $table = 'cities';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

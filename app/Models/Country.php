<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'added_by',
        'added_at',
        'updated_by',
        'updated_at',
    ];

    protected $table = 'countries';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'country',
        'added_by',
        'added_at',
        'updated_by',
        'updated_at',
    ];

    protected $table = 'states';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

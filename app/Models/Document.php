<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 
        'parent',
        'file',
        'added_by',
        'added_at',
        'updated_by',
        'updated_at'
    ];
    protected $table = 'documents';
    protected $primaryKey = 'id';
    protected $guarded = ['id', 'type', 'parent'];
    protected $hidden = ['deleted_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'file' => 'json'
    ];
}

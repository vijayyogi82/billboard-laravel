<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
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
        'field',
        'value'
    ];
    protected $table = 'app_settings';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Billboard extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode',
        'printing_size',
        'substrate',
        'price_30_days',
        'rope_access',
        'printing_service',
        'flighting_service',
        
        'format_accepted',
        'duration',
        'files_naming',
        'max_size',
        'bit_rate',
        'compression_format',
        'submission',
        'slot_duration',
        'uptime',
        'price_per_slot',
        'min_slot',
        'allow_contact',
        'billboard_type',

        'status',
       'added_by',
       'added_at',
       'updated_by',
       'updated_at',
    ];

    protected $table = 'billboards';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function getSearchable()
    {
        return [
            ['class' => 'App\Models\Billboard', 'key' => 'barcode', 'validation' => 'barcode', 'value' => 'billboards.barcode'],
            ['class' => 'App\Models\Billboard', 'key' => 'printing_size', 'validation' => 'printing_size', 'value' => 'billboards.printing_size'],
            ['class' => 'App\Models\Billboard', 'key' => 'billboard_type', 'validation' => 'billboard_type', 'value' => 'billboards.billboard_type'],
            ['class' => 'App\Models\Billboard', 'key' => 'added_at', 'validation' => 'added_at', 'value' => 'billboards.added_at'],
        ];
    }
    
    public static function getSortable()
    {
        return [
            'id',
            'barcode',
            'billboard_type',
            'status',
        ];
    }

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }
        return $query->where('billboards.barcode', 'like', '%' . $search . '%')
            ->orWhere(DB::getTablePrefix() . 'billboards`.`printing_size', 'like', '%' . $search . '%')
            ->orWhere(DB::getTablePrefix() . 'billboards`.`duration', 'like', '%' . $search . '%');
    }

    public function flighting_services()
    {
        return $this->hasMany('App\Models\FlightingService', 'billboard_id');
    }

    public function printing_services()
    {
        return $this->hasMany('App\Models\PrintingService', 'billboard_id');
    }

    public function billboard_details()
    {
        return $this->hasOne('App\Models\BillboardDetails', 'billboard');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->added_at)->diffForHumans();
    }

    public function getModifiedAtAttribute()
    {
        if (!$this->updated_at) {
            return null;
        }
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    public function added_by()
    {
        return $this->belongsTo('App\Models\User', 'added_by');//->without("profile_logo");
    }

    public function updated_by()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');//->without("profile_logo");
    }
}

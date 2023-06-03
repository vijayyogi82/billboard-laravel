<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PrintingService extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'billboard_id',
        'service_provider',
        'price',
        'substrate',
        'independent',
        'added_by',
        'added_at',
        'updated_by',
        'updated_at',
    ];

    protected $table = 'printing_services';
    protected $primaryKey = 'id';
    public $timestamps = false;

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
        return $this->belongsTo('App\Models\User', 'added_by')->select(['id', 'display_name', 'title', 'first_name', 'last_name', 'user_email']);//->without("profile_logo");
    }

    public function updated_by()
    {
        return $this->belongsTo('App\Models\User', 'updated_by')->select(['id', 'display_name', 'title', 'first_name', 'last_name', 'user_email']);//->without("profile_logo");
    }
}

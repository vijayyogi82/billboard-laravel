<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'campaign_name',
        'advertiser',
        'category',
        'street_address',
        'country_id',
        'country_name',
        'state_id',
        'state_name',
        'provience_id',
        'provience_name',
        'city_id',
        'city_name',
        'suburb_id',
        'suburb_name',
        'latitude',
        'longitude',
        'start_date',
        'end_date',
        'status',
        'added_by',
        'added_at',
        'updated_by',
        'updated_at',
    ];

    protected $table = 'campaigns';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function getSearchable()
    {
        return [
            ['class' => 'App\Models\Campaign', 'key' => 'barcode', 'validation' => 'barcode', 'value' => 'campaigns.barcode'],
            ['class' => 'App\Models\Campaign', 'key' => 'category', 'validation' => 'category', 'value' => 'campaigns.category'],
            ['class' => 'App\Models\Campaign', 'key' => 'campaign_name', 'validation' => 'campaign_name', 'value' => 'campaigns.campaign_name'],
            ['class' => 'App\Models\Campaign', 'key' => 'added_at', 'validation' => 'added_at', 'value' => 'campaigns.added_at'],
        ];
    }

    public static function getSortable()
    {
        return [
            'barcode',
            'campaign_name',
            'category',
            'start_date',
            'end_date',
            'status',
            'added_at'
        ];
    }

    public function campaignBillboards()
    {
        return $this->hasMany('App\Models\CampaignBillboard', 'campaign');
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

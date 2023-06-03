<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CampaignBillboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign',
        'billboard',
        'status',
        'no_package',
        'slot_duration',
        'added_by',
        'added_at',
    ];

    protected $table = 'campaign_billboards';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function billboard()
    {
        return $this->belongsTo('App\Models\Billboard', 'billboard');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign', 'campaign');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->added_at)->diffForHumans();
    }

    public function added_by()
    {
        return $this->belongsTo('App\Models\User', 'added_by')->select(['id', 'display_name', 'title', 'first_name', 'last_name', 'user_email']);//->without("profile_logo");
    }
}

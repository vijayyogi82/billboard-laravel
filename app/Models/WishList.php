<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'type_id',
       'added_by',
       'added_at',
    ];

    protected $table = 'wish_lists';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign', 'type_id');
    }

    public function billboard()
    {
        return $this->belongsTo('App\Models\Billboard', 'type_id');
    }
}

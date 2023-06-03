<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use ESolution\DBEncryption\Traits\EncryptedAttribute;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, EncryptedAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'phone',
        'contact_person',
        'alternate_email',
        'alternate_phone',
        'role_id',
        'role_name',
        'photo',            
        'name_of_company',
        'register_name',
        'vat_gst_number',
        'building_number',
        'building_name',
        'street_address',
        'city_id',
        'state_id',
        'country_id',
        'postal_code',
        'po_box',
        'alt_city',
        'alt_state',
        'alt_country',
        'alt_postal_code',
        'country_code',
        'city_code',
        'teliphone_number',
        'is_verified',
        'verified_at',
        'activated',
        'added_by',
        'added_at',
        'updated_by',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified_at' => 'datetime',
    ];

    protected $encryptable = [
        'name',
        'phone',
        'contact_person',
        'alternate_email',
        'alternate_phone',
        'name_of_company',
        'register_name',
        'vat_gst_number',
        'building_number',
        'building_name',
        'street_address',
        'po_box',
        'alt_city',
        'alt_state',
        'alt_country',
        'alt_postal_code',
        'teliphone_number',
    ];

    public $timestamps = false;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
 
    public function getJWTCustomClaims()
    {
        return [];
    }

}

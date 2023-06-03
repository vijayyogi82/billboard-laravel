<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category')->select(['id', 'name']);
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type')->select(['id', 'name']);
    }
}

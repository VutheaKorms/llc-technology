<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

//    public function brand()
//    {
//        return $this->belongsTo('App\Models\Brand','brand_id');
//    }

    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id','id');
    }
}

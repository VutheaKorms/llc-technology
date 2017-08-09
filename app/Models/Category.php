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
        'brand_id',
        'user_id',
    ];

    public function brands()
    {
        return $this->belongsTo('App\Models\Brand','brand_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id','id');
    }

    public function product_photos()
    {
        return $this->hasMany('App\Models\ProductPhoto','category_id','id');
    }
}

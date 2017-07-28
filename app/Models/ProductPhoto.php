<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
    protected $fillable = ['product_id','name', 'size','type','thumb_path','path','status','category_id'];

    public function products()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
}

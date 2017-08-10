<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'address1',
        'address2',
        'state',
        'country',
        'postal_code',
        'status',
    ];

    public function contact()
    {
        return $this->hasMany('App\Models\Contact','address_id','id');
    }

}

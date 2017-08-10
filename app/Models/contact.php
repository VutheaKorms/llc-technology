<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contact extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'contact_name',
        'phone_number1',
        'phone_number2',
        'email_address',
        'address_id',
        'postal_code',
        'status',
        'user_id',
    ];

    public function address()
    {
        return $this->belongsTo('App\Models\Address','address_id');
    }
}

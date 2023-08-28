<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $table = 'discount_codes';

    protected $fillable = [
        'name',
        'code',
        'amount',
        'start_at',
        'expires_at',
    ];

}

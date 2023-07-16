<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    protected $fillable = [
        'name',
        'business_category_id',
        'price',
        'time',
        'type',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessDisplay extends Model
{

    
    protected $fillable = [
        'vi_name',
        'en_name',
        'slug',
        'business_category_id'
    ];

}


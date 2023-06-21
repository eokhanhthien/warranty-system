<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{

    
    protected $fillable = [
        'vi_name',
        'en_name',
        'slug'
    ];

}


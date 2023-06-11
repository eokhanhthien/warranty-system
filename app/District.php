<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'id',
        'districts_name',
        'type',
        'city_id',
    ];
}

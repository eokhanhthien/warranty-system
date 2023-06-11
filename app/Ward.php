<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';

    protected $fillable = [
        'id',
        'wards_name',
        'type',
        'district_id',
    ];
}

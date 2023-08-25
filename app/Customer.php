<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements Authenticatable
{

    use \Illuminate\Auth\Authenticatable;
    
    protected $fillable = [
        'full_name',
        'email',
        'password',
    ];

}

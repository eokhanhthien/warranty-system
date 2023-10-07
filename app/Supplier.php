<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model implements Authenticatable
{

    use \Illuminate\Auth\Authenticatable;
    protected $table = 'suppliers';
    
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
    ];

}

<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model implements Authenticatable
{

    use \Illuminate\Auth\Authenticatable;
    protected $table = 'receipts';
    
    protected $fillable = [
        'supplier_id',
        'purchase_date',
        'status',
        'note',
        'business_id',
    ];

}

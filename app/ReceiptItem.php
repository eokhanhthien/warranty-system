<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model implements Authenticatable
{

    use \Illuminate\Auth\Authenticatable;
    protected $table = 'receipt_items';
    
    protected $fillable = [
        'receipt_id',
        'product_id',
        'variant_id',
        'quantity',
    ];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferGateway extends Model
{

    protected $table = 'transfer_gateways';

    protected $fillable = [
        'bank_id', 
        'account_no',
        'account_name',
        'template'
    ];
}

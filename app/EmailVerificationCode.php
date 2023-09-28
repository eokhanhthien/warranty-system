<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailVerificationCode extends Model
{

    protected $table = 'email_verification_codes';

    protected $fillable = [
        'email', 
        'code',
        'expires_at',
    ];
}

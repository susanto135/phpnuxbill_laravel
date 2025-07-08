<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'username',
        'password',
        'photo',
        'pppoe_username',
        'pppoe_password',
        'pppoe_ip',
        'fullname',
        'address',
        'city',
        'district',
        'state',
        'zip',
        'phonenumber',
        'email',
        'coordinates',
        'account_type',
        'balance',
        'service_type',
        'auto_renewal',
        'status',
        'created_by',
        'last_login',
    ];
}

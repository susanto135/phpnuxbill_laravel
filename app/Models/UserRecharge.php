<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRecharge extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'customer_id',
        'username',
        'plan_id',
        'namebp',
        'recharged_on',
        'recharged_time',
        'expiration',
        'time',
        'status',
        'method',
        'routers',
        'type',
        'admin_id',
    ];
}

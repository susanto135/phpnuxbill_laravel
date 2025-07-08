<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'invoice',
        'username',
        'user_id',
        'plan_name',
        'price',
        'recharged_on',
        'recharged_time',
        'expiration',
        'time',
        'method',
        'routers',
        'type',
        'note',
        'admin_id',
    ];
}

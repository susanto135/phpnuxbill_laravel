<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'name_plan',
        'id_bw',
        'price',
        'price_old',
        'type',
        'typebp',
        'limit_type',
        'time_limit',
        'time_unit',
        'data_limit',
        'data_unit',
        'validity',
        'validity_unit',
        'shared_users',
        'routers',
        'is_radius',
        'pool',
        'plan_expired',
        'expired_date',
        'enabled',
        'prepaid',
        'plan_type',
        'device',
        'on_login',
        'on_logout',
    ];
}

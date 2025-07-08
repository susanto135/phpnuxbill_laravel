<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'username',
        'user_id',
        'gateway',
        'gateway_trx_id',
        'plan_id',
        'plan_name',
        'routers_id',
        'routers',
        'price',
        'pg_url_payment',
        'payment_method',
        'payment_channel',
        'pg_request',
        'pg_paid_response',
        'expired_date',
        'created_date',
        'paid_date',
        'trx_invoice',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'code',
        'type',
        'value',
        'description',
        'max_usage',
        'usage_count',
        'status',
        'min_order_amount',
        'max_discount_amount',
        'start_date',
        'end_date',
    ];
}

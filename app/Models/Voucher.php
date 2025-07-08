<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'type',
        'routers',
        'id_plan',
        'code',
        'user',
        'status',
        'used_date',
        'generated_by',
    ];
}

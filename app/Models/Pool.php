<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'pool_name',
        'local_ip',
        'range_ip',
        'routers',
    ];
}

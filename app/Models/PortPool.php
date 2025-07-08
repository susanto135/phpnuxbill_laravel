<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortPool extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'public_ip',
        'port_name',
        'range_port',
        'routers',
    ];
}

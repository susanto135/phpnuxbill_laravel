<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'name',
        'ip_address',
        'username',
        'password',
        'description',
        'coordinates',
        'status',
        'last_seen',
        'coverage',
        'enabled',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadiusAccount extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'acctsessionid',
        'username',
        'realm',
        'nasid',
        'nasipaddress',
        'nasportid',
        'nasporttype',
        'framedipaddress',
        'acctsessiontime',
        'acctinputoctets',
        'acctoutputoctets',
        'acctstatustype',
        'macaddr',
        'dateAdded',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'date',
        'type',
        'description',
        'userid',
        'ip',
    ];
}

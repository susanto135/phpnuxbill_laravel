<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'setting',
        'value',
    ];
}

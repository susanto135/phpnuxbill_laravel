<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bandwidth extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'name_bw',
        'rate_down',
        'rate_down_unit',
        'rate_up',
        'rate_up_unit',
        'burst',
    ];
}

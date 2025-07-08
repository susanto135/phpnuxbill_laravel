<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'tbl',
        'tbl_id',
        'name',
        'value',
    ];
}

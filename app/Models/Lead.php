<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'notes',
    ];
}

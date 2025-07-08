<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'orders',
        'position',
        'user',
        'enabled',
        'title',
        'widget',
        'content',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerField extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'customer_id',
        'field_name',
        'field_value',
    ];
}

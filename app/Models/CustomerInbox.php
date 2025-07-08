<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInbox extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'customer_id',
        'date_created',
        'date_read',
        'subject',
        'body',
        'from',
        'admin_id',
    ];
}

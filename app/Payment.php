<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'amount', 'status', 'method', 'gateway'
    ];

    protected $attributes = [
        'status' => 0
    ];
}

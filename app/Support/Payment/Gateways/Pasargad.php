<?php

namespace App\Support\Payment\Gateways;

use App\Order;
use Illuminate\Http\Request;

class Pasargad implements GatewayInterface
{
    public function pay(Order $order)
    {
        dd('Pasargad Pay');
    }

}

<?php

namespace App\Support\Payment\Gateways;

use App\Order;
use Illuminate\Http\Request;

class Saman implements GatewayInterface
{
    public function pay(Order $order)
    {
        dd('Saman Pay');
    }

}

<?php

namespace App\Support\Payment\Gateways;

use App\Order;
use Illuminate\Http\Request;

interface GatewayInterface
{
    const TRANSACTION_FAILED = 'transaction.failed';
    const TRANSACTION_SUCCESS = 'transaction.success';


    public function pay(Order $order);

}

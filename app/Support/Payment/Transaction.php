<?php

namespace App\Support\Payment;

use App\Payment;
use App\Support\Payment\Gateways\Pasargad;
use App\Support\Payment\Gateways\Saman;
use Illuminate\Http\Request;


class Transaction
{
    private $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function checkout($order)
    {
        $payment = $this->makePayment($order);
        if ($this->request->method =='online') {
            $this->gatewayFactory()->pay($order);
        }
        return $order;
    }

    public function makePayment($order)
    {
        return Payment::create([
            'order_id' => $order->id,
            'method' => $this->request->method,
            'amount' => $order->amount
        ]);
    }

    private function gatewayFactory()
    {
        $gateWaysClasses = [
            'saman' => Saman::class,
            'pasargad' => Pasargad::class
        ];
        $gateWay = $this->request->gateway ;//Pasargad or Saman
        return resolve($gateWaysClasses[$gateWay]);
    }
}

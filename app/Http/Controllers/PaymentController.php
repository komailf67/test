<?php

namespace App\Http\Controllers;

use App\Order;
use App\Support\Payment\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $transaction;
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
    public function onlinePayment(Request $request , Order $order)
    {
        if ($order->user_id == $request->user_id){
            $order =  $this->transaction->checkout($order);
        }
        return response()->json([
            'seccess' => false,
            'message' => 'you can not pay this order'
        ]);
    }
}

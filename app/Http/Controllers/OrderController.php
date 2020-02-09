<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function setOrder(Request $request)
    {
        $userId = $request->user_id;
        $amount = $request->amount;
        $products = json_decode($request->productIdAndCount,true);
        $productIdAndCount = $this->createArrayOfProductAndCount($products);
        $order = Order::create([
            'user_id' => $userId,
            'code' => bin2hex(Str::random(12)),
            'amount' => $amount,
        ]);
        $order->product()->attach($productIdAndCount);
        return $order;
    }
    public function createArrayOfProductAndCount($productIdAndCount)
    {
        $output = [];
        foreach ($productIdAndCount as $product){
            $output[ $product['product_id'] ] = ["quantity" => $product['quantity']];
        }
        return $output;
    }
}

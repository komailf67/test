<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Support\Basket\Basket;
use App\Support\Basket\Contracts\BasketInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function setOrder(Request $request)
    {
        $userId = $request->user_id;
        $amount = $request->amount;
        $products = json_decode($request->productIdAndCount,true);
        $productIdAndCount = $this->createArrayOfProductAndCount($products);
        $bCheckAllProductsExist = $this->checkProductsExist($productIdAndCount);
        if ($bCheckAllProductsExist['action']){
            $order =  $this->basket->saveOrder($userId , $amount , $productIdAndCount );
            return response()->json([
                'message' => 'order was save successfully',
                'data' => $order
            ]);
        }
        return response()->json([
            'message' => 'this products does not exist',
            'data' => $bCheckAllProductsExist['notExistProduct']
        ]);
    }
    public function createArrayOfProductAndCount($productIdAndCount)
    {
        $output = [];
        foreach ($productIdAndCount as $product){
            $output[ $product['product_id'] ] = ["quantity" => $product['quantity']];
        }
        return $output;
    }

    public function checkProductsExist($productIdAndCount)
    {
        $notExistProducts = [];//array of products and existence in database
        foreach ($productIdAndCount as $productId => $quantity){
            $product = Product::find($productId);
            $bIsProductExist = $this->basket->isProductExist($product , $quantity['quantity']);
            if (!$bIsProductExist){
                $notExistProducts[] = $product->description;
            }
        }

        if ($notExistProducts){
            return [
                'action' => false,
                'notExistProduct' => $notExistProducts
            ];
        }
        return [
            'action' => true,
        ];
    }
}

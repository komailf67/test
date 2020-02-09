<?php
    /**
     * Created by PhpStorm.
     * User: Komail
     * Date: 2/9/2020
     * Time: 12:47 PM
     */

    namespace App\Support\Basket;


    use App\Order;
    use App\Product;
    use Illuminate\Support\Str;


    class Basket
    {
        public function update()
        {

        }
        public function isProductExist(Product $product , $quantity)
        {
            return $product->stock >= (int)$quantity;
        }

        public function saveOrder($userId , $amount , $productIdAndCount )
        {
            $this->decreaseStock($productIdAndCount);
            $order = Order::create([
                'user_id' => $userId,
                'code' => bin2hex(Str::random(12)),
                'amount' => $amount,
            ]);
            $order->product()->attach($productIdAndCount);
            return $order;
        }

        public function decreaseStock($productIdAndCount)
        {
            foreach ($productIdAndCount as $productId => $quantity){
                $product = Product::find($productId);
                $currentCount = $product->stock - $quantity['quantity'];
                $product->stock = $currentCount;
                $product->save();
            }
            return true;
        }

    }
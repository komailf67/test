<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function insertProduct(Request $request)
    {
        $productData = [
          'description' => $request->description,
          'category_id' => $request->category_id,
          'price'       => $request->price,
          'stock'       => $request->stock,
        ];
        $product = Product::create($productData);
        if ($product){
            return response()->json([
               'data' => $product,
               'success' => true,
               'messages' => 'new product saved successfully',
            ]);
        }
    }
}

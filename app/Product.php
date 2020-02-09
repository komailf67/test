<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =['description','category_id' , 'price' , 'stock'];

    public function hasStock(int $quantity)
    {
        return $this->stock >= $quantity;
    }
}

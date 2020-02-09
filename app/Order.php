<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =['user_id','code','amount'];

    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

}

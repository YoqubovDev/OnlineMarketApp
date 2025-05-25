<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity'];

//    public function product()
//    {
//        return $this->belongsTo(Product::class);
//    }
    // app/Models/CartItem.php
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

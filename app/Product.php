<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The shopping carts that belongs to products.
     */
    public function shoppingCarts()
    {
        return $this->belongsToMany(ShoppingCart::class);
    }
}

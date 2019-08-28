<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status'];

    /**
     * The products that belongs to shopping carts.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps();
    }

    /**
     * Find or create shopping cart.
     *
     * @param  int  $sessionID
     * @return \App\ShoppingCart
     */
    public static function findOrCreate($sessionID)
    {
        if ($sessionID) {
            return ShoppingCart::find($sessionID);
        }

        return ShoppingCart::create(['status' => 'uncompleted']);
    }
}

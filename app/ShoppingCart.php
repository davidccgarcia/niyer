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
     * Get products count into shopping cart.
     */
    public function productsCount()
    {
        return $this->products()->count();
    }

    /**
     * Get the subtotal of the shopping cart.
     */
    public function subtotal()
    {
        return number_format($this->products()->sum('price'), 3);
    }

    /**
     * Get shipping price.
     */
    public function shipping()
    {
        return number_format(5.00, 3);
    }

    /**
     * Get total of the shopping cart.
     */
    public function total()
    {
        return number_format($this->subtotal() + $this->shipping(), 3);
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

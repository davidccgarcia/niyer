<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{Product, ShoppingCart, User};
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShoppingCartsModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_find_or_create_shopping_carts()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $product = factory(Product::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->post(route('shopping_carts.store'), [
                'product_id' => $product->id,
            ])
            ->assertRedirect(route('products.show', $product->id));

        $sessionID = session()->get('shopping_cart');
        $shoppingCart = ShoppingCart::findOrCreate($sessionID);
        session()->put('shopping_cart', $shoppingCart->id);

        $this->assertDatabaseHas('shopping_carts', [
            'status' => 'uncompleted'
        ]);

        $this->assertDatabaseHas('product_shopping_cart', [
            'product_id' => $product->id,
            'shopping_cart_id' => $shoppingCart->id,
        ]);
    }
}

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
    public function it_load_cart_page()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $product1 = factory(Product::class)->create(['user_id' => $user->id]);
        $product2 = factory(Product::class)->create(['user_id' => $user->id]);

        $sessionID = session()->get('shopping_cart');
        $shoppingCart = ShoppingCart::findOrCreate($sessionID);
        session()->put('shopping_cart', $shoppingCart->id);

        $shoppingCart->products()->attach([
            $product1->id, $product2->id
        ]);

        $this->actingAs($user)
            ->get(route('cart.index'))
            ->assertViewIs('shopping_carts.index')
            ->assertStatus(200)
            ->assertSeeText($product1->name)
            ->assertSeeText($product2->name);
    }

    /**
     * @test
     */
    public function show_default_message_if_shopping_cart_is_empty()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('cart.index'))
            ->assertStatus(200)
            ->assertSeeText('You have no items in your cart');
    }

    /**
     * @test
     */
    public function it_find_or_create_shopping_carts()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $product = factory(Product::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->post(route('cart.store'), [
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

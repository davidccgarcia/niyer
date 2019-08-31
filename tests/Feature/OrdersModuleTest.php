<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{Product, ShoppingCart, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_load_create_order_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('orders.create'))
            ->assertStatus(200)
            ->assertSeeText('Create Order');
    }

    /**
     * @test
     */
    public function it_create_order_if_exists_shopping_cart()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $product = factory(Product::class)->create(['user_id' => $user->id]);

        $sessionID = session()->get('shopping_cart');
        $shoppingCart = ShoppingCart::findOrCreate($sessionID);
        session()->put('shopping_cart', $shoppingCart->id);

        $shoppingCart->products()->attach($product->id);

        $this->actingAs($user)
            ->post(route('orders.store'), [
                'shopping_cart_id' => $shoppingCart->id,
                'address' => '60 29th St, CA 94110, EE. UU.',
                'city' => 'San Francisco',
                'receiver_name' => 'Jeff Way',
                'email' => 'jeffway@laracast.com',
            ])
            ->assertRedirect(route('orders.show', 1));

        $this->assertDatabaseHas('orders', [
            'shopping_cart_id' => $shoppingCart->id,
            'address' => '60 29th St, CA 94110, EE. UU.',
            'city' => 'San Francisco',
            'receiver_name' => 'Jeff Way',
            'email' => 'jeffway@laracast.com',
            'status' => 'created',
            'total' => 52.00,
        ]);
    }
}

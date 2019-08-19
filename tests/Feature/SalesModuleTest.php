<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{Product, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_create_a_new_sale()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();

        $this->actingAs($user)
            ->post(route('sales.store'), [
                'observation' => 'Lorem ipsum dolor...',
                'products' => [$product1->id, $product2->id],
                "quantity_{$product1->id}" => 2,
                "quantity_{$product2->id}" => 3,
            ])
            ->assertRedirect(route('sales'));

        $this->assertDatabaseHas('sales', [
            'total' => 235.00,
            'observation' => 'Lorem ipsum dolor...',
        ]);

        $this->assertDatabaseHas('sale_details', [
            'product_id' => $product1->id,
            'quantity' => 2
        ]);

        $this->assertDatabaseHas('sale_details', [
            'product_id' => $product2->id,
            'quantity' => 3
        ]);

        $this->assertDatabaseHas('products', [
            'stock' => $product1->stock - 2,
        ]);

        $this->assertDatabaseHas('products', [
            'stock' => $product2->stock - 3,
        ]);
    }
}

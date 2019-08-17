<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_create_a_new_product()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('products.store'), [
                'name' => 'Product 1',
                'description' => 'lorem ipsum dolor...',
                'stock' => 12,
                'wholesale_unit_value' => '24.000',
                'unit_value' => '47.000'
            ])
            ->assertRedirect(route('products'));

        $this->assertDatabaseHas('products', [
            'name' => 'Product 1',
            'description' => 'lorem ipsum dolor...',
            'stock' => 12,
            'wholesale_unit_value' => '24.000',
            'unit_value' => '47.000'
        ]);
    }

    /**
     * @test
     */
    public function it_load_products_page()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();

        $this->actingAs($user)
            ->get(route('products'))
            ->assertStatus(200)
            ->assertSeeText('Products')
            ->assertViewHas('products', function ($products) use ($product1, $product2) {
                return $products->contains($product1) && $products->contains($product2);
            })
            ->assertSeeText($product1->name)
            ->assertSeeText($product2->name);
    }
}

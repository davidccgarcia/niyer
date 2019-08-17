<?php

namespace Tests\Feature;

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
}

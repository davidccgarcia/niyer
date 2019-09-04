<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_show_products_in_home()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $product1 = factory(Product::class)->create(['user_id' => $user->id]);
        $product2 = factory(Product::class)->create(['user_id' => $user->id]);

        $this->get(route('home.index'))
            ->assertStatus(200)
            ->assertSeeText('Products')
            ->assertViewHas('products', function ($products) use ($product1, $product2) {
                return $products->contains($product1) && $products->contains($product2);
            });
    }
}

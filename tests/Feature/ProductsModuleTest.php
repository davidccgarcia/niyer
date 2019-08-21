<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{Product, User};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_load_create_product_page()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('products.create'))
            ->assertStatus(200)
            ->assertSeeText('Add Products');
    }

    /**
     * @test
     */
    public function it_create_a_new_product()
    {
        $this->withoutExceptionHandling();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('products.store'), [
                'name' => 'Product 1',
                'description' => 'lorem ipsum dolor...',
                'photo' => $file,
                'stock' => 12,
                'wholesale_unit_value' => '24.000',
                'unit_value' => '47.000'
            ])
            ->assertRedirect(route('products'));

        // Assert the file was stored...
        Storage::disk('public')->assertExists('photos/' . $file->hashName());

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

    /**
     * @test
     */
    public function it_show_a_default_message_when_there_are_not_products()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get(route('products'))
            ->assertStatus(200)
            ->assertSeeText('Products')
            ->assertSeeText('No hay productos.');
    }
}

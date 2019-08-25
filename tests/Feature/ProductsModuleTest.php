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
                'price' => '47.000'
            ])
            ->assertRedirect(route('products.index'));

        // Assert the file was stored...
        Storage::disk('public')->assertExists('photos/product1.jpeg');

        $this->assertDatabaseHas('products', [
            'name' => 'Product 1',
            'description' => 'lorem ipsum dolor...',
            'stock' => 12,
            'photo' => 'photos/product1.jpeg',
            'wholesale_unit_value' => '24.000',
            'price' => '47.000'
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
            ->get(route('products.index'))
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
            ->get(route('products.index'))
            ->assertStatus(200)
            ->assertSeeText('Products')
            ->assertSeeText('No hay productos.');
    }

    /**
     * @test
     */
    public function it_load_edit_product_page()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $product1 = factory(Product::class)->create();

        $this->actingAs($user)
            ->get(route('products.edit', $product1->id))
            ->assertStatus(200)
            ->assertSeeText('Edit Product');
    }

    /**
     * @test
     */
    public function it_updates_product()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $this->actingAs($user)
            ->patch(route('products.update', $product->id), [
                'name' => 'Producto',
                'description' => 'Producto editado',
                'photo' => $file,
                'stock' => 11,
                'wholesale_unit_value' => '25.000',
                'price' => '48.000',
            ])
            ->assertStatus(302);

        // Delete the last file
        Storage::disk('public')->delete($product->photo);

        // Assert the file was stored...
        Storage::disk('public')->assertExists('photos/producto.jpeg');

        $this->assertDatabaseHas('products', [
            'name' => 'Producto',
            'description' => 'Producto editado',
            'photo' => 'photos/producto.jpeg',
            'stock' => 11,
            'wholesale_unit_value' => '25.000',
            'price' => '48.000',
        ]);
    }

    /**
     * @test
     */
    public function it_delete_the_product()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $this->actingAs($user)
            ->delete(route('products.destroy', $product->id))
            ->assertRedirect(route('products.index'));

        // Delete the last file
        Storage::disk('public')->delete('photos/wi57oGPEutvquPWRr67c8NlgjLS77BlcEYLqM97v.jpeg');

        $this->assertDatabaseMissing('products', [
            'name' => $product->name,
            'description' => $product->description,
            'photo' => 'photos/wi57oGPEutvquPWRr67c8NlgjLS77BlcEYLqM97v.jpeg',
            'stock' => $product->stock,
            'wholesale_unit_value' => $product->whosale_unit_value,
            'price' => $product->price,
        ]);
    }
}

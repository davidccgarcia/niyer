<?php

use Illuminate\Support\Str;
use App\Product;

if (! function_exists('photo')) {
    function photo(Product $product)
    {
        return str_replace([
            'á', 'é', 'í', 'ó', 'ú'
            ], [
                'a', 'e', 'i', 'o', 'u'
            ],
            Str::snake($product->name)
        ) . '.jpeg';
    }
}

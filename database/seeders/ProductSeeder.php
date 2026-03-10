<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $attributeValues = AttributeValue::all();

        Product::factory(30)->create()->each(function ($product) use ($attributeValues) {
            // Привязуємо 2-4 випадкових значення атрибутів
            $randomValues = $attributeValues->random(rand(2, 4));
            $product->attributeValues()->attach($randomValues->pluck('id'));
        });
    }
}

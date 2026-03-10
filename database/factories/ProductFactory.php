<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(rand(3, 5), true);

        return [
            'category_id' => Category::whereDoesntHave('children')->inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'sku' => strtoupper(Str::random(6)),
            'description' => fake()->paragraphs(2, true),
            'price' => fake()->randomFloat(2, 999, 99999),
            'old_price' => fake()->optional(0.3)->randomFloat(2, 999, 99999),
            'quantity' => fake()->numberBetween(0, 100),
            'is_active' => true,
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $catalog = Category::create(['name' => 'Каталог товарів', 'slug' => 'katalog', 'is_active' => true]);

        $notebooks = Category::create(['name' => 'Ноутбуки', 'slug' => 'noutbuky', 'parent_id' => $catalog->id, 'is_active' => true]);
        $macbook = Category::create(['name' => 'MacBook', 'slug' => 'macbook', 'parent_id' => $notebooks->id, 'is_active' => true]);
        Category::create(['name' => 'MacBook Air', 'slug' => 'macbook-air', 'parent_id' => $macbook->id, 'is_active' => true]);
        Category::create(['name' => 'MacBook Pro', 'slug' => 'macbook-pro', 'parent_id' => $macbook->id, 'is_active' => true]);

        $phones = Category::create(['name' => 'Смартфони', 'slug' => 'smartfony', 'parent_id' => $catalog->id, 'is_active' => true]);
        $apple = Category::create(['name' => 'Apple', 'slug' => 'apple-phones', 'parent_id' => $phones->id, 'is_active' => true]);
        $iphone = Category::create(['name' => 'iPhone', 'slug' => 'iphone', 'parent_id' => $apple->id, 'is_active' => true]);
        Category::create(['name' => 'iPhone 17 Pro Max', 'slug' => 'iphone-17-pro-max', 'parent_id' => $iphone->id, 'is_active' => true]);
        Category::create(['name' => 'iPhone 17 Pro', 'slug' => 'iphone-17-pro', 'parent_id' => $iphone->id, 'is_active' => true]);

        $accessories = Category::create(['name' => 'Аксесуари', 'slug' => 'aksesuary', 'parent_id' => $catalog->id, 'is_active' => true]);
        Category::create(['name' => 'Чохли для смартфонів', 'slug' => 'chokhly', 'parent_id' => $accessories->id, 'is_active' => true]);

        $charging = Category::create(['name' => 'Зарядні станції', 'slug' => 'zaryadni-stantsiyi', 'parent_id' => $catalog->id, 'is_active' => true]);
        Category::create(['name' => 'EcoFlow', 'slug' => 'ecoflow-stations', 'parent_id' => $charging->id, 'is_active' => true]);
    }
}

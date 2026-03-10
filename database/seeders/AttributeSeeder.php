<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $color = Attribute::create(['name' => 'Колір', 'slug' => 'color', 'type' => 'color', 'is_filterable' => true]);
        $color->values()->createMany([
            ['value' => 'Sky Blue', 'sort_order' => 0],
            ['value' => 'Silver', 'sort_order' => 1],
            ['value' => 'Space Black', 'sort_order' => 2],
            ['value' => 'Cosmic Orange', 'sort_order' => 3],
            ['value' => 'White', 'sort_order' => 4],
        ]);

        $ram = Attribute::create(['name' => 'Оперативна пам\'ять', 'slug' => 'ram', 'type' => 'select', 'is_filterable' => true]);
        $ram->values()->createMany([
            ['value' => '8GB', 'sort_order' => 0],
            ['value' => '16GB', 'sort_order' => 1],
            ['value' => '24GB', 'sort_order' => 2],
            ['value' => '36GB', 'sort_order' => 3],
        ]);

        $storage = Attribute::create(['name' => 'Накопичувач', 'slug' => 'storage', 'type' => 'select', 'is_filterable' => true]);
        $storage->values()->createMany([
            ['value' => '256GB', 'sort_order' => 0],
            ['value' => '512GB', 'sort_order' => 1],
            ['value' => '1TB', 'sort_order' => 2],
            ['value' => '2TB', 'sort_order' => 3],
        ]);

        $screen = Attribute::create(['name' => 'Розмір екрану', 'slug' => 'screen', 'type' => 'select', 'is_filterable' => true]);
        $screen->values()->createMany([
            ['value' => '13"', 'sort_order' => 0],
            ['value' => '14"', 'sort_order' => 1],
            ['value' => '15"', 'sort_order' => 2],
            ['value' => '16"', 'sort_order' => 3],
            ['value' => '6.3"', 'sort_order' => 4],
            ['value' => '6.9"', 'sort_order' => 5],
        ]);

        $battery = Attribute::create(['name' => 'Ємність батареї', 'slug' => 'battery', 'type' => 'text', 'is_filterable' => false]);
        $battery->values()->createMany([
            ['value' => '3600 Wh', 'sort_order' => 0],
            ['value' => '2016 Wh', 'sort_order' => 1],
        ]);

        // Bind attributes to categories
        $macbookAir = Category::where('slug', 'macbook-air')->first();
        $macbookPro = Category::where('slug', 'macbook-pro')->first();
        $iphone17PM = Category::where('slug', 'iphone-17-pro-max')->first();
        $iphone17P = Category::where('slug', 'iphone-17-pro')->first();
        $ecoflow = Category::where('slug', 'ecoflow-stations')->first();

        $macbookAir?->attributes()->attach([$color->id, $ram->id, $storage->id, $screen->id]);
        $macbookPro?->attributes()->attach([$color->id, $ram->id, $storage->id, $screen->id]);
        $iphone17PM?->attributes()->attach([$color->id, $storage->id, $screen->id]);
        $iphone17P?->attributes()->attach([$color->id, $storage->id, $screen->id]);
        $ecoflow?->attributes()->attach([$battery->id]);
    }
}

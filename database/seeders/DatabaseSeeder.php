<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Material;
use App\Models\MaterialProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Size;
use App\Models\SizeProduct;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Shop::factory(10)->create();
        Order::factory(10)->create();
        Product::factory(10)->create();
        OrderProduct::factory(30)->create();
        Category::factory(4)->create();
        CategoryProduct::factory(30)->create();
        Color::factory(4)->create();
        ColorProduct::factory(30)->create();
        Material::factory(4)->create();
        MaterialProduct::factory(30)->create();
        Size::factory(4)->create();
        SizeProduct::factory(30)->create();
    }
}


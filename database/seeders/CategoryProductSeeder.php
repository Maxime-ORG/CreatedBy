<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    public function run()
    {
        $randomCategory = Category::inRandomOrder()->first();
        $randomProduct = Product::inRandomOrder()->first();
        CategoryProduct::factory()->count(20)->withUniqueCombination($randomCategory->id, $randomProduct->id)->create();
    }
}

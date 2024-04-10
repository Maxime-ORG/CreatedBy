<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryProduct>
 */
class CategoryProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $categoryIds = Category::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        return [
            'category_id' => $this->faker->randomElement($categoryIds),
            'product_id' => $this->faker->randomElement($productIds),
        ];
    }
}

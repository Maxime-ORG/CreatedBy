<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ColorProduct>
 */
class ColorProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colorIds = Color::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        return [
            'color_id' => $this->faker->randomElement($colorIds),
            'product_id' => $this->faker->randomElement($productIds),
        ];
    }
}

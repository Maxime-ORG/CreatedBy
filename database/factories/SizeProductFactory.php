<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SizeProduct>
 */
class SizeProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sizeIds = Size::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        return [
            'size_id' => $this->faker->randomElement($sizeIds),
            'product_id' => $this->faker->randomElement($productIds),
        ];
    }
}

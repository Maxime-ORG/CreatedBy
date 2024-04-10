<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialProduct>
 */
class MaterialProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materialIds = Material::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        return [
            'material_id' => $this->faker->randomElement($materialIds),
            'product_id' => $this->faker->randomElement($productIds),
        ];
    }
}

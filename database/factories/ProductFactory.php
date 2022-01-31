<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit_price' => $this->faker->randomDigit(),
            'quantity' => $this->faker->randomDigit(),
            'name' => $this->faker->word(),
            'cost_price' => $this->faker->randomDigit(),
            'description' => $this->faker->sentence(),
            'serial_number' => Product::getSerialNumber(),
        ];
    }
}

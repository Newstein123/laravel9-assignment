<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'slug' => $this->faker->text(10),
            'price'=> $this->faker->randomDigit(),
            'description' => $this->faker->text(20),
            'quantity' => $this->faker->randomDigit(),
        ];
    }
}

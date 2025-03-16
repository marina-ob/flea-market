<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;

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
            'user_id' => User::factory(),
            'image' => $this->faker->imageUrl(),
            'condition' => $this->faker->randomElement(['良好', '目立った傷や汚れなし', 'やや傷や汚れあり', '状態が悪い']),
            'name' => $this->faker->word,
            'brand' => $this->faker->word,
            'explanation' => $this->faker->text,
            'price' => $this->faker->numberBetween(1000, 100000),
        ];
    }
}

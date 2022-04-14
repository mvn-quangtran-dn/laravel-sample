<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryIds = Category::pluck('id');
        return [
            'name' => $this->faker->name(),
            'quantity' => rand(1,100),
            'category_id' => $this->faker->randomElement($categoryIds),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address,
            'tel' => $this->faker->phoneNumber,
            'age' => rand(1,100),
            'gender' => rand(0,1)
        ];
    }
}

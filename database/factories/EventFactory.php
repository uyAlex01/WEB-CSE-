<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
            'location' => $this->faker->city(),
            'available_tickets' => $this->faker->numberBetween(50, 200),
            'category_id' => rand(1, 5), // adjust as needed
            'image' => 'default.jpg',   // or use $this->faker->imageUrl()
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'AdSoyad' => $this->faker->name(),
            'ComeDate' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'WhereFrom' => $this->faker->name(),
            'WhoTook' => $this->faker->name(),
            'DeliverData' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}

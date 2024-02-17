<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(2),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}

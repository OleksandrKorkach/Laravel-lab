<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition()
    {
        $project = Project::inRandomOrder()->first();
        $user = $project->creator;

        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(2),
            'creator_id' => $user->id,
            'project_id' => $project->id,
            'status_id' => Status::inRandomOrder()->first()->id,
            'deadline' => $this->faker->dateTimeBetween('+1 day', '+1 month'),
            'is_active' => $this->faker->boolean(),
        ];
    }
}

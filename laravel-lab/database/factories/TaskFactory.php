<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TaskFactory extends Factory
{
    public function definition()
    {
        $project = Project::inRandomOrder()->first();
        $user = Arr::random($project->users->pluck('id')->toArray());

        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(4),
            'creator_id' => $user,
            'project_id' => $project->id,
            'status_id' => Status::inRandomOrder()->first()->id,
            'deadline' => $this->faker->dateTimeBetween('-1 week', '+1 month'),
            'is_active' => $this->faker->boolean(),
        ];
    }
}

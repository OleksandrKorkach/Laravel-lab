<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        Project::factory()->count(50)->create([
            'user_id' => function () use ($userIds) {
                return Arr::random($userIds);
            }
        ]);
    }
}

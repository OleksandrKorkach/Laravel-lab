<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectUserSeeder extends Seeder
{
    public function run()
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $this->addUserToProjectIfNotExists($project, $project->creator->id);

            for ($i = 0; $i < 14; $i++) {
                $user = User::inRandomOrder()->first()->id;
                $this->addUserToProjectIfNotExists($project, $user);
            }
        }
    }

      private function addUserToProjectIfNotExists($project, $userId): void
      {
        if (!$project->users->contains('id', $userId)) {
            DB::table('project_user')->insert([
                'project_id' => $project->id,
                'user_id' => $userId,
            ]);
        }
    }
}

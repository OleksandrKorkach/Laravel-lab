<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectStatusSeeder extends Seeder
{
    public function run()
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $this->addStatusToProjectIfNotExists($project, 1);
            $this->addStatusToProjectIfNotExists($project, 2);
            $this->addStatusToProjectIfNotExists($project, 3);

            for ($i = 0; $i < 5; $i++) {
                $statusId = Status::inRandomOrder()->first()->id;
                $this->addStatusToProjectIfNotExists($project, $statusId);
            }
        }
    }

    private function addStatusToProjectIfNotExists($project, $statusId): void
    {
        if (!$project->statuses->contains('id', $statusId)) {
            DB::table('project_status')->insert([
                'project_id' => $project->id,
                'status_id' => $statusId,
                'is_disabled' => false,
            ]);
        }
    }
}

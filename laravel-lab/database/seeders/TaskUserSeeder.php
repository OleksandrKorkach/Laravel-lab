<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TaskUserSeeder extends Seeder
{
    public function run()
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $projectTasks = $project->tasks;
            $projectUserIds = $project->users->pluck('id')->toArray();

            foreach ($projectTasks as $projectTask) {
                $availableUsers = $projectUserIds;
                $countUsers = count($availableUsers);
                if ($countUsers < 3) {
                    $usersToAssign = $availableUsers;
                } else {
                    $usersToAssign = Arr::random($availableUsers, 3);
                }

                $assignedUsers = []; // Массив для отслеживания уже назначенных пользователей

                foreach ($usersToAssign as $userId) {
                    // Проверяем, не был ли уже этот пользователь назначен на эту задачу
                    if (!in_array($userId, $assignedUsers)) {
                        $this->addUserToTaskIfNotExists($projectTask, $userId);
                        $assignedUsers[] = $userId;
                    }
                }
            }
        }
    }

    private function addUserToTaskIfNotExists($task, $userId): void
    {
        if (!$task->users->contains('id', $userId)) {
            DB::table('task_user')->insert([
                'task_id' => $task->id,
                'user_id' => $userId,
            ]);
        }
    }
}

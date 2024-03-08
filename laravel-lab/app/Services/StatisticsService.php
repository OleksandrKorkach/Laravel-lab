<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectUserRole;
use App\Models\Task;

class StatisticsService
{

    public function getProjectStatistics($projectId): array
    {
        $tasksDistribution = $this->getProjectTasksDistribution($projectId);
        $membersDistribution = $this->getProjectMembersDistribution($projectId);
        $projectInfo = $this->getProjectInfo($projectId);
        return [
            'project_info' => $projectInfo, // array
            'tasks_distribution' => $tasksDistribution,
            'members_distribution' => $membersDistribution,// key => value
            ];
    }

    private function getProjectInfo($projectId): array
    {
        $project = Project::find($projectId);
        $membersCount = $project->users()->count();
        $tasksCount = $project->tasks()->where('is_active', true)->count();
        $projectStatuses = [];
        $projectRoles = [];
        $roles = ProjectUserRole::whereIn('id', $project->users->pluck('pivot.role_id')->unique())->get();

        foreach ($project->statuses as $status) {
            $projectStatuses[$status->id] = $status->name;
        }

        foreach ($roles as $role) {
            $projectRoles[$role->id] = $role->name;
        }

        return [
            'project_id' => $projectId,
            'members_count' => $membersCount,
            'tasks_count' => $tasksCount,
            'project_statuses' => $projectStatuses,
            'project_roles' => $projectRoles,
        ];
    }

    private function getProjectTasksDistribution($projectId): array
    {
        $project = Project::find($projectId);

        $tasksDistribution = [];

        $statuses = $project->statuses;

        foreach ($statuses as $status) {
            $count = Task::query()
                ->where('project_id', $projectId)
                ->where('status_id', $status->id)
                ->where('is_active', true)
                ->count();
            $tasksDistribution[$status->id] = $count;
        }

        return $tasksDistribution;
    }

    private function getProjectMembersDistribution($projectId): array
    {
        $project = Project::find($projectId);

        $membersDistribution = [];

        $projectRoles = $project->users->pluck('pivot.role_id')->unique();

        foreach ($projectRoles as $role) {
            $count = $project->users
                ->where('pivot.role_id', $role)
                ->count();
            if ($count > 0) {
                $membersDistribution[$role] = $count;
            }
        }

        return $membersDistribution;
    }
}

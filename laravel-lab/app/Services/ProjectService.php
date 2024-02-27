<?php

namespace App\Services;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectService
{
    public function getUserProjects()
    {
        return User::find(Auth::id())->projects;
    }

    public function getProject($id)
    {
        return Project::query()->where('id', $id)->first();
    }

    public function storeProject(StoreProjectRequest $request): void
    {
        $project = new Project();
        $user = User::find(Auth::id());

        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->user_id = Auth::id();

        $project->save();

        $project->users()->attach($user);
        $project->statuses()->attach([Status::TODO, Status::IN_PROGRESS, Status::DONE]);
    }

    public function searchUsersByName(mixed $query)
    {
        if (!empty($query)) {
            return User::query()
                ->where('name', 'LIKE', $query . '%')
                ->get();
        } else {
            return User::query()
                ->latest()
                ->take(50)
                ->get();
        }
    }

    public function addMember($userId, $projectId): void
    {
        $user = User::find($userId);
        $project = Project::find($projectId);

        $project->users()->attach($user);
    }

    public function deleteMember($userId, $projectId): void
    {
        $user = User::find($userId);
        $project = Project::find($projectId);

        $project->users()->detach($user);
    }

    public function getTaskStatuses(): Collection
    {
        return Status::all();
    }

    public function getProjectTasks($id): Collection|array
    {
        return Task::query()
            ->where('project_id', $id)
            ->get();
    }

    public function destroyProject($projectId): void
    {
        Project::destroy($projectId);
    }

    public function storeProjectStatuses(mixed $selectedStatusIds, $projectId): void
    {
        $project = Project::findOrFail($projectId);
        $project->statuses()->sync($selectedStatusIds);
    }

}

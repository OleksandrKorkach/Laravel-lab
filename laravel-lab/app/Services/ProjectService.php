<?php

namespace App\Services;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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
    }

    public function searchUserByName(mixed $query)
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

    public function addUserToProject($userId, $projectId)
    {
        $user = User::find($userId);
        $project = Project::find($projectId);

        $project->users()->attach($user);
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(): View
    {
        $projects = $this->projectService->getUserProjects();
        return view('projects', [
            'projects' => $projects,
        ]);
    }

    public function get($id): View
    {
        $project = $this->projectService->getProject($id);
        return view('projects.workspace', [
            'project' => $project,
        ]);
    }

    public function create(): View
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $this->projectService->storeProject($request);
        return redirect()->to('/projects');
    }

    public function getProjectUsersToAdd($projectId, Request $request): View
    {
        $project = Project::find($projectId);

        $availableUsers = $this->projectService->searchUserByName($request->input('query'));

        return view('projects.add-user', [
            'project' => $project,
            'users' => $availableUsers,
        ]);
    }

    public function addUserToProject($project, Request $request): RedirectResponse
    {
        $this->projectService->addUserToProject($request->input('user_id'), $project);
        return redirect()->to('/projects/' . $project);
    }


}

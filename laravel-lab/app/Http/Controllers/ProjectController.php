<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\enums\TaskStatus;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Services\ProjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function show($projectId): View
    {
        $project = $this->projectService->getProject($projectId);
        $statuses = $this->projectService->getTaskStatuses();
        $tasks = $this->projectService->getProjectTasks($projectId);

        return view('projects.workspace', [
            'project' => $project,
            'statuses' => $statuses,
            'tasks' => $tasks,
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

    public function edit(): RedirectResponse
    {
        return redirect()->to(route('projects.index'));
    }

    public function update(): RedirectResponse
    {
        return redirect()->to(route('projects.index'));
    }

    public function destroy($projectId): RedirectResponse
    {
        $this->projectService->destroyProject($projectId);
        return redirect()->to('/projects');
    }

    public function searchAvailableUsers($projectId, Request $request): View
    {
        $project = Project::find($projectId);
        $availableUsers = $this->projectService->searchUsersByName($request->input('query'));

        return view('projects.add-user', [
            'project' => $project,
            'users' => $availableUsers,
        ]);
    }

    public function addMember(Request $request): RedirectResponse
    {
        $projectId = $request->input('projectId');
        $userId = $request->input('userId');

        $this->projectService->addMember($userId, $projectId);

        return redirect()
            ->to(route('projects.show', $projectId))
            ->withFragment('tab-content-2');
    }

    public function deleteMember(Request $request): RedirectResponse
    {
        $projectId = $request->input('projectId');
        $userId = $request->input('userId');

        $this->projectService->deleteMember($userId, $projectId);

        return redirect()
            ->to(route('projects.show', $projectId))
            ->withFragment('tab-content-2');
    }

    public function storeStatuses($projectId, Request $request): RedirectResponse
    {
        $this->projectService->storeProjectStatuses($request->input('status_ids', []), $projectId);

        return redirect()
            ->to(route('projects.show', $projectId))
            ->withFragment('tab-content-3');
    }

}

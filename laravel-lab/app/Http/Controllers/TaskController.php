<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(Request $request): RedirectResponse
    {
        $this->taskService->store($request);
        return redirect()
            ->to(route('projects.show', $request->input('project')))
            ->withFragment('tab-content-1');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $this->taskService->destroyTask($request->input('taskId'));
        return redirect()->back();
    }

    public function deleteAssignee(Request $request): RedirectResponse
    {
        $taskId = $request->input('taskId');
        $userId = $request->input('userId');

        $this->taskService->deleteMember($userId, $taskId);

        return redirect()->back();
    }
}

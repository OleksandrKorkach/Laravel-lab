<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function store(Request $request): void
    {
        $task = new Task();

        $task->title = $request['title'];
        $task->description = $request['description'];
        $task->project_id = $request->input('project');
        $task->creator_id = Auth::id();
        $task->status_id = $request->input('status');
        $task->deadline = $request['deadline'];
        $task->is_active = true;

        $task->save();

        $task->users()->attach($request->input('users', []));
    }

    public function destroyTask($taskId): void
    {
        Task::destroy($taskId);
    }

    public function deleteAssignee($userId, $taskId): void
    {
        $user = User::find($userId);
        $task = Task::find($taskId);

        $task->users()->detach($user);
    }

    public function addAssignee($userId, $taskId): void
    {
        $user = User::find($userId);
        $task = Task::find($taskId);

        $task->users()->attach($user);
    }

    public function updateStatus(mixed $taskId, mixed $newStatusId): void
    {
        $task = Task::find($taskId);

        $task->status_id = $newStatusId;
        $task->save();
    }

    public function updateTask($taskId, Request $request): void
    {
        $task = Task::find($taskId);

        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();
    }

}

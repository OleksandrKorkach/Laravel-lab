<form id="addAssigneeForm{{$task->id}}" method="POST" action="{{ route('tasks.add-assignee', ['taskId' => $task->id]) }}" class="flex items-center gap-2">
    @csrf
    <div class="">
        <select form="addAssigneeForm{{$task->id}}" name="userId" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            @foreach($project->users as $user)
                @unless($task->users->contains($user))
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endunless
            @endforeach
        </select>
    </div>
    <div>
        <button form="addAssigneeForm{{$task->id}}" type="submit" class="p-2 font-semibold rounded-md bg-gray-800 text-white text-[17px] text-center">
            Додати
        </button>
    </div>
</form>

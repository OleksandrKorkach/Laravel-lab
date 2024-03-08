<x-modal name="{{ $taskModalName }}" :show="$errors->taskShow->isNotEmpty()" focusable :maxWidth="'2xl'">
    <div class="p-10">
        <div class="text-right">
            <h2>Створив: {{ $task->creator->name }}</h2>
        </div>

        <div class="text-right">
            <h2>{{(new DateTime($task->created_at))->format('Y M d, H:i')}}</h2>
        </div>
        @if (!empty($task->deadline))
            @php
                $deadline = new DateTime($task->deadline);
                $now = new DateTime();
                $formattedDeadline = $deadline->format('Y M d, H:i');
            @endphp

            <div class="text-right {{$secondsUntilDeadline < 0 ? 'text-red-500':''}}">
                <h2>{{$secondsUntilDeadline < 0 ? 'Протерміновано!':''}} {{ $formattedDeadline }}</h2>
            </div>
        @endif

{{--    Task creator    --}}
        @if($isOwner)
            @php
                $isAllUsersAssigned = count($task->users) < count($project->users);
            @endphp
            <form id="updateForm{{$task->id}}" action="{{ route('tasks.update', ['taskId' => $task->id])}}" method="post">
        {{--        Title        --}}
                @csrf
                @method('PATCH')

                <div class="mt-2 font-semibold">
                    <input form="updateForm{{$task->id}}" type="text" name="title" value="{{$task->title}}"
                           class="border-none w-full focus:ring-transparent bg-transparent p-0 rounded">
                </div>
        {{--        Description        --}}
                @if(!empty($task->description))
                    <div class="mt-4 flex">
                        <div id="taskDescription{{$task->id}}" class="w-full border-none rounded focus:outline-none" contenteditable oninput="updateHiddenInput({{$task->id}})">
                            {{$task->description}}
                        </div>
                        <input type="hidden" name="description" id="hidden-description{{$task->id}}" value="{{$task->title}}">
                    </div>
                @endif
        {{--        Assignees        --}}
                @if(sizeof($task->users->pluck('id')) > 0)
                    <div class="mt-4">
                        <h2 class="font-semibold ">Призначено:</h2>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach($task->users as $user)
                                <div class="flex min-w-[45%]  justify-between">
                                    <div class="">
                                        {{$user->name}}
                                    </div>
                                    <div>
                                        <form id="deleteAssignee{{$task->id}}" method="post"
                                              action="{{ route('tasks.delete-assignee', ['taskId' => $task->id, 'userId' => $user->id])}}">
                                            @csrf

                                            <input form="deleteAssignee{{$task->id}}" type="hidden" name="_method" value="DELETE">
                                            <button form="deleteAssignee{{$task->id}}"
                                                    type="submit"
                                                    class="w-[28px] h-[28px] rounded-md bg-red-500 text-white text-[17px] text-center">
                                                x
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
{{--        Add assignee select        --}}
                <div class="flex mt-6 justify-start">
                    @if($isAllUsersAssigned)
                        <div class="flex">
                            @include('projects.partial.task-table-form.task-modal.add-assignee')
                        </div>
                    @endif
                </div>
{{--        Delete and update task buttons        --}}
                <div class="flex justify-end gap-2 mt-2 items-center">
                    <div class="">
                        @include('projects.partial.task-table-form.task-modal.delete-task')
                    </div>
                    <button form="updateForm{{$task->id}}" type="submit" class="p-2 font-semibold rounded-md bg-gray-800 text-white text-[17px] text-center">
                        Оновити
                    </button>
                </div>
            </form>

        @else
{{--     Common member       --}}
            <div class="mt-1 font-semibold">
                {{$task->title}}
            </div>
            @if(!empty($task->description))
                <div class="mt-4">
                    {{$task->description}}
                </div>
            @endif<h2 class="font-semibold mt-2">Призначено:</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($task->users as $user)
                    <div class="flex min-w-[45%] justify-between">
                        <div class="">
                            {{$user->name}}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-modal>

<script>
    function updateHiddenInput(taskId) {
        document.getElementById('hidden-description' + taskId).value = document.getElementById('taskDescription' + taskId).innerText;
    }
</script>

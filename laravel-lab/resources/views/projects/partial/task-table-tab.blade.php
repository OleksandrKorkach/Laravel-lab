<div class="flex w-full overflow-x-scroll min-h-[500px] gap-1 ">
    @foreach($project->statuses as $status)
        @php
            $statusId = $status->id;
            $statusName = $status->name;
            $statusModalName = 'confirm-task-creation-' . $statusName;
        @endphp
        {{--  Columns  --}}
        <div class="flex-shrink-0 bg-gray-200 p-2 w-[22%] shadow-sm rounded-t-md "
             id="status-{{ $statusId }}"
             data-status-id="{{ $statusId }}"
             ondrop="return drop(event)"
             ondragover="allowDrop(event)">
            <div id="column-header" class="flex items-center justify-between font-semibold">
                <div>{{$status->name}}</div>
                @include('projects.partial.task-table-form.add-task')
            </div>
            {{--      Task placeholder      --}}
            <div class="flex flex-col gap-2 bg-gray-200 mt-2 "
                 id="tasks-container-{{ $statusId }}"
                 ondrop="drop(event)"
                 ondragover="allowDrop(event)">
                @foreach($tasks as $task)
                    @if($task->is_active && $task->status_id == $status->id)
                        @php
                            $secondsUntilDeadline = now()->diffInSeconds($task->deadline, false);
                            $taskModalName = 'confirm-task-show-' . $task->id;
                            $isOwner = $task->creator->id == Auth::id();
                            $isUserAssigned = $task->users->pluck('id')->contains(Auth::id());
                            $isDeadlineToday = $secondsUntilDeadline > 0 && $secondsUntilDeadline <= 24 * 3600;
                            $isDeadlineMissed = $secondsUntilDeadline < 0;
                        @endphp
                {{--    Task   --}}
                        <button
                            class="
                            bg-white block p-2 shadow-md font-semibold text-[17px] text-left hover:bg-gray-100
                            {{$isUserAssigned ? 'border-l-4 border-green-400': ''}}
                            {{$isDeadlineMissed && $isUserAssigned ? 'bg-red-200 hover:bg-red-300 border-l-4 border-red-500': ''}}
                            {{$isDeadlineToday && $isUserAssigned ? 'border-l-4 border-orange-400': ''}}
                            "
                            id="task-{{ $task->id }}"
                            draggable="true"
                            ondragstart="drag(event)"
                            data-task-id="{{ $task->id }}"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', '{{ $taskModalName }}')">

                            <div class="">
                                {{$task->title}}
                            </div>

                            <div class="flex justify-between items-center mt-3 font-normal">
                                <div class="flex gap-2">
                                    @if($isDeadlineMissed && $isUserAssigned)
                                        <div class="">&#x1F6A9;</div>
                                    @elseif($isDeadlineToday && $isUserAssigned)
                                        <div class="">&#x23F3;</div>
                                    @endif
                                </div>
                                <div>
                                    {{--    Formatted deadline    --}}
                                    @include('projects.partial.task-table-form.deadline-in-column')
                                </div>
                            </div>
                        </button>
                        @include('projects.partial.task-table-form.show-task-modal')
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<script>
    function allowDrop(event) {
        event.preventDefault();
    }

    function drag(event) {
        event.dataTransfer.setData("task_id", event.target.dataset.taskId);
        event.dataTransfer.setData("status_id", event.target.closest('.flex-shrink-0').dataset.statusId);
    }

    function drop(event) {
        event.preventDefault();
        var task_id = event.dataTransfer.getData("task_id");
        var status_id = event.dataTransfer.getData("status_id");
        var new_status_id = event.target.closest('.flex-shrink-0').dataset.statusId;

        if (status_id !== new_status_id) {
            var formData = new FormData();
            formData.append('task_id', task_id);
            formData.append('new_status_id', new_status_id);

            fetch('/tasks/update-status', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            })
                .then(response => {
                    if (response.ok) {
                        updateTaskStatusOnPage(task_id, new_status_id);
                    } else {
                        console.error('Ошибка при обновлении статуса задачи');
                    }
                })
                .catch(error => {
                    console.error('Ошибка при обновлении статуса задачи:', error);
                });

            function updateTaskStatusOnPage(task_id, new_status_id) {
                var taskElement = document.getElementById('task-' + task_id);

                var statusContainer = document.getElementById('tasks-container-' + new_status_id);
                statusContainer.appendChild(taskElement);
            }
        }
    }
</script>


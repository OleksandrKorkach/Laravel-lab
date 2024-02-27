<div class="flex w-full overflow-x-scroll min-h-[500px] gap-1">
    @foreach($project->statuses as $status)
        @php
            $statusId = $status->id;
            $statusName = $status->name;
            $statusModalName = 'confirm-task-creation-' . $statusName;
        @endphp
        <div class="flex-shrink-0 bg-gray-200 p-2 w-[22%] shadow-sm rounded-t-md">
            <div class="flex items-center justify-between font-semibold">
                <div class="">{{$status->name}} </div>
                @include('projects.partial.task-table-form.add-task')
            </div>

            <div class="flex flex-col gap-2 bg-gray-200 mt-2">
                @foreach($tasks as $task)
                    @if($task->is_active && $task->status_id == $status->id)
                        @php
                            $hoursUntilDeadline = now()->diffInHours($task->deadline, false);
                            $taskModalName = 'confirm-task-show-' . $task->id;
                        @endphp
                        <button
                            class="bg-white block p-2 shadow-md text-[17px] relative text-left hover:bg-gray-100"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', '{{ $taskModalName }}')">
                            @if($task->users->pluck('id')->contains(Auth::id()))
                                <div class="text-green-500 font-semibold flex justify-between ">
                                    <div class="">Ви назначені на це завдання.</div>
                                </div>
                            @endif
                            @if($hoursUntilDeadline > 0 && $hoursUntilDeadline <= 24)
                                <div class="text-orange-500 font-semibold flex justify-between ">
                                    <div class="">Дедлайн через {{$hoursUntilDeadline}} год.</div>
                                    <div class="">&#9888;</div>
                                </div>
                            @elseif($hoursUntilDeadline < 0)
                                <div class="text-red-500 font-semibold flex justify-between ">
                                    <div class="">Дедлайн протерміновано.</div>
                                    <div class="">&#x23F3;&#x1F6A9;</div>
                                </div>
                            @endif

                            <div class="mt-2">
                                {{$task->title}}
                            </div>
                            <div class="font-semibold mt-2 text-right">
                                <div>{{$task->creator->name}}</div>
                            </div>
                        </button>
                        @include('projects.partial.task-table-form.show-task')
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>


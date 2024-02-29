<x-modal name="{{ $taskModalName }}" :show="$errors->taskShow->isNotEmpty()" focusable :maxWidth="'2xl'">
    <div class="p-10">
        <div class="text-right ">
            <h2>Створив: {{ $task->creator->name }}</h2>
        </div>
        @if (!empty($task->deadline))
            @php
                $deadline = new DateTime($task->deadline);
                $now = new DateTime();
                $deadlineYear = ($deadline->format('Y') != $now->format('Y')) ? ', Y' : '';

                if ($deadline < $now->modify('+1 week')) {
                    $formattedDeadline = $deadline->format('M d, H:i');
                } else {
                    $formattedDeadline = $deadline->format('Y M d, H:i' . $deadlineYear);
                }
            @endphp

            <div class="text-right {{$secondsUntilDeadline < 0 ? 'text-red-500':''}}">
                <h2>{{$secondsUntilDeadline < 0 ? 'Протерміновано!':''}} {{ $formattedDeadline }}</h2>
            </div>
        @endif
        <div>
            <h2 class="font-semibold">Назва:</h2>
            <div class="mt-1">
                {{$task->title}}
            </div>
        </div>
        @if(!empty($task->description))
            <div>
                <h2 class="font-semibold mt-2">Опис:</h2>
                <div class="mt-1">
                    {{$task->description}}
                </div>
            </div>
        @endif
        @if(sizeof($task->users->pluck('id')) > 0)
            <div class="mt-6">
                <h2 class="font-semibold ">Призначено:</h2>
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach($task->users as $user)
                        <div class="flex min-w-[45%]  justify-between">
                            <div class="">
                                {{$user->name}}
                            </div>
                            @if(Auth::id() == $task->creator->id)
                                <div>
                                    <form method="post" action="{{ route('tasks.delete-assignee', ['taskId' => $task->id, 'userId' => $user->id])}}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="w-[28px] h-[28px] rounded-md bg-red-500 text-white text-[17px] text-center">
                                            x
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(Auth::id() == $task->creator->id)
            <form method="post" action="{{ route('tasks.destroy', ['taskId' => $task->id])}}">
                @csrf
                @method('DELETE')

                <button type="submit" class="p-2 font-semibold float-right rounded-md bg-red-500 text-white text-[17px] text-center mt-2 mb-4">
                    Delete
                </button>
            </form>
        @endif
    </div>
</x-modal>

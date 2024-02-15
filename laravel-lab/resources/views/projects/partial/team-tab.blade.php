<section>
    <div>
        <h1 class="text-2xl font-semibold">Команда</h1>
    </div>
    <div class="flex justify-between mt-3">
        <div class="font-semibold flex items-center">
            Власник: {{$project->creator->name}}
        </div>

        @if(Auth::id() == $project->creator->id)
            <div>
                <x-primary-button onclick="location.href='/projects/{{$project->id}}/add-user'">
                    {{__('Додати розробника')}}
                </x-primary-button>
            </div>
        @endif
    </div>

    <div class="flex flex-wrap mt-4">
        @foreach($project->users as $user)
            @if($user->id !== $project->creator->id)
                <div class="min-w-[26%] p-2 border border-gray-300 ">
                    {{$user->name}}
                </div>
            @endif
        @endforeach
    </div>
</section>

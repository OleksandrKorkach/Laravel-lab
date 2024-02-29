<section>
    <div class="flex justify-between">
        <div class="font-semibold flex items-center">
            Власник: {{$project->creator->name}}
        </div>

        @if(Auth::id() == $project->creator->id)
            <div>
                <x-primary-button onclick="location.href='{{ route('projects.search-available-users', $project->id)}}'">
                    {{__('Додати розробника')}}
                </x-primary-button>
            </div>
        @endif
    </div>

    <div class="flex flex-wrap mt-4">
        @foreach($project->users as $user)
            @if($user->id !== $project->creator->id)
                <div class="min-w-[20%] items-center justify-between py-2 pr-2 flex">
                    <div>
                        {{$user->name}}
                    </div>
                    <div>
                        @if(Auth::id() == $project->creator->id)
                            <form method="post" action="{{ route('projects.delete-member', ['projectId' => $project->id, 'userId' => $user->id])}}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="w-[28px] ml-2 h-[28px] rounded-md bg-red-500 text-white text-[17px] text-center">
                                    x
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>

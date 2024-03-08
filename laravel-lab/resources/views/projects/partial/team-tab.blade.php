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
    @php
        $projectRoles = $project->users->pluck('pivot.role_id')->unique();

        $roles = \App\Models\ProjectUserRole::whereIn('id', $projectRoles)->get();
    @endphp
    <div class="mt-6">
        @foreach($roles as $role)
            <h2 class="font-semibold mt-2 text-blue-500">{{$role->name}}</h2>
            <div class="flex flex-wrap gap-5 pl-4">
                @foreach($project->users as $user)
                    @if($user->pivot->role_id == $role->id)
                        <div class="min-w-[17%] justify-between items-center pb-1 flex">
                            <div>
                                {{$user->name}}
                            </div>
                            <div>
                                @if(Auth::id() == $project->creator->id)
                                    @if($user->id != $project->creator->id)
                                        <form method="post" action="{{ route('projects.delete-member', ['projectId' => $project->id, 'userId' => $user->id])}}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="w-[28px] ml-2 h-[28px] rounded-md bg-red-500 text-white text-[17px] text-center">
                                                x
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

</section>

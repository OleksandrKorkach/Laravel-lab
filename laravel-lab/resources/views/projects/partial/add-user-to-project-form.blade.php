<section>
    <div class="flex">
        <div id="search_form" class="w-3/12 p-4">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Find user') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Search for existing users") }}
                </p>
            </header>

            <form id="send-verification" method="post" action="{{ route('verification.send')}}">
                @csrf
            </form>

            <form method="get" action="{{ route('projects.search-available-users', $project->id)}}" class="mt-6 space-y-6" enctype="multipart/form-data">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="query" type="text" class="mt-1 block w-12/12"/>
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Find') }}</x-primary-button>
                </div>
            </form>
        </div>
        <div id="search_results" class="w-9/12 p-4">
            <h1 class="text-lg font-medium text-gray-900">Search results:</h1>
            <div class="flex flex-wrap">
                @foreach($users as $user)
                    @if (!$project->users->contains($user))
                    <div class="flex items-center justify-between p-4 min-w-[50%]">
                        <div id="name" class="text-xl font-bold">
                            {{$user->name}}
                        </div>
                        <div>
                            <form action="{{ route('projects.add-member', ['projectId' => $project->id, 'userId' => $user->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-gray-800 hover:bg-gray-700 flex justify-center items-center rounded w-6 h-6 font-bold text-2xl text-white ml-2">
                                    +
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>



</section>

<section>
    @if($userIsCreator)
        <form method="post" action="{{ route('projects.update', ['project' => $project->id]) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <h2 class="mt-2 font-semibold">Назва:</h2>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-6/12" :value="old('name', $project->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <h2 class="mt-2 font-semibold">Опис:</h2>
                <textarea id="description" name="description" class="mt-1 block w-6/12 rounded min-h-[150px]" required autofocus autocomplete="description">{{ old('description', $project->description) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Зберегти') }}</x-primary-button>
            </div>

        </form>
    @else
        <div>
            <h2 class="mt-2 font-semibold">Назва:</h2>
            <div class="w-6/12">{{$project->name}}</div>
        </div>
        <div>
            <h2 class="mt-2 font-semibold">Опис:</h2>
            <div class="w-9/12">{{$project->description}}</div>
        </div>
    @endif
</section>

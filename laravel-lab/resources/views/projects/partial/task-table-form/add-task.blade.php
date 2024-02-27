<button
    class="bg-gray-800 hover:bg-gray-700 flex justify-center items-center rounded w-6 h-6 font-bold text-xl text-white ml-2"
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', '{{ $statusModalName }}')">
    +
</button>
{{--    <x-primary-button--}}

{{--    >+</x-primary-button>--}}

<x-modal name="{{ $statusModalName }}" :show="$errors->taskCreation->isNotEmpty()" focusable :maxWidth="'2xl'">
    <form method="post"
          action="{{ route('tasks.store', ['project' => $project->id, 'status' => $statusId]) }}"
          class="p-6 w-full justify-center text-center flex flex-col">
        @csrf
        @method('POST')

        <h2 class="text-lg font-medium text-gray-900">
            Додати в статус "{{$statusName}}"
        </h2>

        <div class="mt-6 flex flex-col items-start">
            <h2>Назва</h2>
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-2/4" placeholder="{{ __('Title') }}" />
            <x-input-error :messages="$errors->taskCreation->get('title')" class="mt-2" />

            <h2 class="mt-4">Опис</h2>
            <textarea id="description" name="description" class="mt-1 block w-full h-[200px] rounded"></textarea>
            <x-input-error :messages="$errors->taskCreation->get('description')" class="mt-2" />

            <h2 class="mt-2">Дедлайн</h2>
            <input id="deadline" name="deadline" type="datetime-local" class="mt-3 block " placeholder="{{ __('Deadline') }}" />
            <x-input-error :messages="$errors->taskCreation->get('deadline')" class="mt-2" />

            <h2 class="mt-4">Назначити виконавців</h2>
            <select id="users" name="users[]" multiple class="mt-1 block w-2/4">
                @foreach($project->users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->taskCreation->get('users')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Create Task') }}
            </x-primary-button>
        </div>

    </form>
</x-modal>


<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create project') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Fill project information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('projects.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div>
            <x-input-label for="name" :value="__('Title')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-5/12"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" class="mt-1 block w-full h-[200px] rounded"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>
    </form>
</section>

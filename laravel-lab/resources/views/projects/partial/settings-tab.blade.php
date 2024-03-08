<section>
        <div class="">
            <div class="font-semibold text-center text-xl">
                <h2>Інформація про проект</h2>
            </div>
            <div>
                @include('projects.partial.settings.edit-project-info')
            </div>

            @if($userIsCreator)
                <div class="mt-4 font-semibold text-center text-xl">
                    <h2>Колонки</h2>
                </div>

                <div>
                    @include('projects.partial.settings.set-columns')
                </div>
            @endif
        </div>


    <div class="mt-4">
        @if($userIsCreator)
            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <x-danger-button type="submit" onclick="return confirm('Are you sure you want to delete project?')">
                    {{ __('Видалити проект') }}
                </x-danger-button>
            </form>
        @else
            <form action="{{ route('projects.delete-member', ['projectId' => $project->id, 'userId' => Auth::id()]) }}" method="POST">
                @csrf
                @method('DELETE')

                <x-danger-button type="submit" onclick="return confirm('Are you sure you want to quit project?')">
                    {{ __('Залишити проект') }}
                </x-danger-button>
            </form>
        @endif
    </div>



</section>

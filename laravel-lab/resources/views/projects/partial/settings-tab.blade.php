<section>
    @if(Auth::id() == $project->creator->id)
        <div class="">
            <div class="font-semibold text-center text-xl">
                <h2>Колонки</h2>
            </div>

            <div>
                @include('projects.partial.settings.set-columns')
            </div>
        </div>
    @endif

    <div class="mt-4">
        @if(Auth::id() == $project->creator->id)
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

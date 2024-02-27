<section>
    <form action="{{ route('projects.statuses.store', ['projectId' => $project->id])}}" method="POST">
        @csrf

        <h2 class="mt-2 font-semibold">Активні:</h2>
        <div class="flex flex-wrap">
            @foreach ($project->statuses as $status)
                <div class="w-3/12 pt-1">
                    <label>
                        <input type="checkbox" name="status_ids[]" value="{{ $status->id }}" checked class="rounded">
                        {{ $status->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <h2 class="mt-2 font-semibold">Доступні:</h2>

        <div class="flex flex-wrap">
            @foreach ($statuses as $status)
                @unless ($project->statuses->contains($status))
                    <div class="w-3/12 pt-1">
                        <label>
                            <input type="checkbox" name="status_ids[]" value="{{ $status->id }}" class="rounded">
                            {{ $status->name }}
                        </label>
                    </div>
                @endunless
            @endforeach
        </div>

        <div class="mt-5">
            <x-primary-button>
                Зберегти
            </x-primary-button>
        </div>
    </form>
</section>

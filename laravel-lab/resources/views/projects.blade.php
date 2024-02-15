<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center">
                <div class="text-left p-6 flex justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Ваші проекти</h2>
                    <div>
                        <x-primary-button onclick="location.href='/projects/create'">
                            {{__('Create')}}
                        </x-primary-button>
                    </div>
                </div>
                <div class="flex flex-wrap">
                    @foreach($projects as $project)
                        <a href="/projects/{{$project->id}}" class="
                        {{$project->creator->id == Auth::user()->id ? 'bg-yellow-300' : 'bg-green-200'}}
                        p-4 relative text-gray-900 w-3/12 border border-gray-300 block
                        {{$project->creator->id == Auth::user()->id ? 'hover:bg-yellow-400' : 'hover:bg-green-300'  }}
                        cursor-pointer min-h-[350px]"
                        >
                            <div class="text-left text-2xl font-semibold">
                                {{$project->name}}
                            </div>
                            <div class="h-4">
                            </div>
                            <div class="text-left">
                                {{$project->description}}
                            </div>
                            <div class="h-10">
                            </div>
                            <div class="absolute bottom-0 right-0 mb-3 mr-5 font-semibold">
                                {{$project->creator->name}}
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

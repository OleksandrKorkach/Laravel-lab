<x-app-layout>

    <div class="border-t">
        <div class="max-w-7xl mx-auto">
            <div class="overflow-hidden">
{{--                <div class="w-[20%] p-10 flex-col flex">--}}
{{--                    <div class="">--}}
{{--                        Мои проекти--}}
{{--                    </div>--}}
{{--                    <div class="">--}}
{{--                        Приймаю участь--}}
{{--                    </div>--}}
{{--                    <div class="">--}}
{{--                        Є власником--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-[80%] p-14">--}}
{{--                    <div class="flex flex-wrap">--}}
{{--                        @foreach($projects as $project)--}}
{{--                            <a href="/projects/{{$project->id}}" class="--}}
{{--                        {{$project->creator->id == Auth::user()->id ? 'bg-yellow-300' : 'bg-green-300'}}--}}
{{--                        p-4 relative text-gray-900 w-4/12 border-2 border-gray-100 block--}}
{{--                        {{$project->creator->id == Auth::user()->id ? 'hover:bg-yellow-400' : 'hover:bg-green-400'  }}--}}
{{--                        cursor-pointer min-h-[350px]"--}}
{{--                            >--}}
{{--                                <div class="text-left text-2xl font-semibold">--}}
{{--                                    {{$project->name}}--}}
{{--                                </div>--}}
{{--                                <div class="h-4">--}}
{{--                                </div>--}}
{{--                                <div class="text-left">--}}
{{--                                    {{$project->description}}--}}
{{--                                </div>--}}
{{--                                <div class="h-10">--}}
{{--                                </div>--}}
{{--                                <div class="absolute bottom-0 right-0 mb-3 mr-5 font-semibold">--}}
{{--                                    {{$project->creator->name}}--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="text-left p-6 flex justify-between">
                    <div class="flex items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Ваші проекти</h2>
                    </div>
                    <div>
                        <x-primary-button onclick="location.href='/projects/create'">
                            {{__('Створити')}}
                        </x-primary-button>
                    </div>
                </div>
                <div class="flex flex-wrap">
                    @foreach($projects as $project)
                        <a href="/projects/{{$project->id}}" class="
                        {{$project->creator->id == Auth::user()->id ? 'bg-yellow-300' : 'bg-green-300'}}
                        {{$project->creator->id == Auth::user()->id ? 'hover:bg-yellow-400' : 'hover:bg-green-400'  }}
                        p-4 relative text-gray-900 w-3/12 border-2 border-white block
                        cursor-pointer min-h-[350px]">
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

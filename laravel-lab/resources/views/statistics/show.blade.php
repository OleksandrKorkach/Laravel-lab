<x-app-layout>
    <div class="px-8 pt-5">

        <div class="flex gap-4">
            <x-primary-button class="">
                <a href="{{route('projects.show', ['project' => $statistics['project_info']['project_id']])}}">
                    {{ __('Проект') }}
                </a>
            </x-primary-button>
        </div>

        <div class="flex justify-end pr-4 gap-2 border-b">
            <div class=" w-7/12 px-6 pt-10">
                <h2 class="font-semibold text-center text-xl">
                    Розподіл завдань за статусами
                </h2>
                <div class="flex flex-wrap justify-between mt-4 ">
                    @foreach($statistics['tasks_distribution'] as $status => $taskCount)
                        <div class="flex justify-between w-5/12">
                            <div>
                                {{$statistics['project_info']['project_statuses'][$status]}}
                            </div>
                            <div class="font-bold text-blue-500">
                                {{$taskCount}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-right mt-6">
                    Всього: {{$statistics['project_info']['tasks_count']}}
                </div>
            </div>

            <div class="w-5/12 h-[500px] pl-6">
                <canvas id="taskDistribution" data-tasks-distribution="{{ json_encode($statistics['tasks_distribution']) }}"></canvas>
            </div>
        </div>

        <div class="flex justify-end pr-4 gap-2 border-b">
            <div class=" w-7/12 px-6 pt-10">
                <h2 class="font-semibold text-center text-xl">
                    Розподіл команди за напрямками
                </h2>
                <div class="flex flex-wrap justify-between mt-4 ">
                    @foreach($statistics['members_distribution'] as $role => $memberCount)
                        <div class="flex justify-between w-5/12">
                            <div>
                                {{$statistics['project_info']['project_roles'][$role]}}
                            </div>
                            <div class="font-bold text-blue-500">
                                {{$memberCount}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-right mt-6">
                    Всього: {{$statistics['project_info']['members_count']}}
                </div>
            </div>

            <div class="w-5/12 h-[500px] pl-6">
                <canvas id="membersDistribution" data-members-distribution="{{ json_encode($statistics['members_distribution']) }}"></canvas>
            </div>
        </div>
    </div>

</x-app-layout>




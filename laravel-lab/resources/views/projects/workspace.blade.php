<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-3">
            {{ __($project->name) }}
        </h2>
    </x-slot>

    <div class="border">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="flex">
                    <div class="w-2/12 flex flex-col text-center p-10 bg-gray-200 h-dvh">
                        <button class="p-3 border-b border-gray-400 tab-btn" data-target="tab-content-1">Task Table</button>
                        <button class="p-3 border-b border-gray-400 tab-btn" data-target="tab-content-2">Team</button>
                        <button class="p-3 tab-btn" data-target="tab-content-3">Settings</button>
                    </div>
                    <div class="w-10/12 p-8">
                        <div id="tab-content-1" class="">
                            @include('projects.partial.task-table-tab')
                        </div>
                        <div id="tab-content-2" class="hidden">
                            @include('projects.partial.team-tab')
                        </div>
                        <div id="tab-content-3" class="hidden">
                            @include('projects.partial.settings-tab')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        // Получение кнопок вкладок
        const tabs = document.querySelectorAll('.tab-btn');

        // Получение блоков контента
        const contents = document.querySelectorAll('[id^=tab-content]');

        // Добавление обработчика событий для каждой вкладки
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Скрытие всех блоков контента
                contents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Отображение только выбранного блока контента
                const targetId = tab.getAttribute('data-target');
                const targetContent = document.getElementById(targetId);
                targetContent.classList.remove('hidden');
            });
        });
    </script>
</x-app-layout>



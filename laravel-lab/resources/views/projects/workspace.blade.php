<x-app-layout>
    @php
        $userIsCreator = Auth::id() == $project->creator->id;
    @endphp
    <div class="border-t">
        <div class="max-w-7xl mx-auto ">
            <div class="overflow-hidden shadow-sm">
                <div class="p-6">
                    <div class="flex gap-2">
                        <button class="font-semibold hover:font-bold tab-btn" data-target="tab-content-1">Завдання &#128196;</button>
                        <button class="hover:font-bold tab-btn" data-target="tab-content-2">Команда &#128101;</button>
                        <button class="tab-btn hover:font-bold" data-target="tab-content-3">Налаштування &#9881;</button>
                        <button class="hover:font-bold">
                            <a href="{{route('statistics.show', ['projectId' => $project->id])}}">
                                Статистика &#128202;
                            </a>
                        </button>
                    </div>
                    <div class="w-full mt-6">
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
        const tabs = document.querySelectorAll('.tab-btn');

        const contents = document.querySelectorAll('[id^=tab-content]');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                contents.forEach(content => {
                    content.classList.add('hidden');
                });

                tabs.forEach(tab => {
                    tab.classList.remove('font-semibold');
                });
                tab.classList.add('font-semibold');

                const targetId = tab.getAttribute('data-target');
                const targetContent = document.getElementById(targetId);
                targetContent.classList.remove('hidden');

                // После изменения вкладки, изменяем URL-адрес страницы
                history.pushState(null, null, '#' + targetId);
            });
        });

        // При загрузке страницы, проверяем хэш и отображаем соответствующую вкладку
        window.onload = () => {
            const hash = window.location.hash;
            if (hash) {
                const targetId = hash.replace('#', '');
                const targetTab = document.querySelector(`[data-target="${targetId}"]`);
                if (targetTab) {
                    targetTab.click();
                }
            }
        };
    </script>
</x-app-layout>



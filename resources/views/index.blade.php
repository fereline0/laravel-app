<x-app-layout>
    <div class="space-y-4">
        <h2 class="text-xl font-semibold">Объявления</h2>
        <form method="GET" action="{{ route('welcome') }}">
            <x-bladewind::input type="text" name="search" label="Введите поисковый запрос"
                value="{{ request('search') }}" class="rounded-md" />
            <x-bladewind::select name="sort" :data="$sortOptions" placeholder="Сортировка"
                selected_value="{{ request('sort') }}" />
            <x-bladewind::button can_submit="true">Поиск</x-bladewind::button>
        </form>
        @foreach ($announcements as $announcement)
            <x-bladewind::card>
                <div class="space-y-1">
                    <x-link href="{{ route('announcements.show', $announcement->id) }}">
                        <h2 class="font-semibold text-xl leading-tight">{{ $announcement->title }}</h2>
                    </x-link>
                    <p>{{ Auth()->user() && Auth()->user()->id == $announcement->user->id ? 'Опубликовано вами' : $announcement->user->name }}</p>
                    <p class="text-gray-500">Было создано {{ $announcement->created_at->locale('ru')->diffForHumans() }}</p>
                </div>
            </x-bladewind::card>
        @endforeach
        {{ $announcements->links() }}

        @auth
            <h2 class="text-xl font-semibold">Ваши обращения</h2>
            <div class="flex justify-end">
                <a href="{{ route('requests.create') }}">
                    <x-bladewind::button>Создать новое обращение</x-bladewind::button>
                </a>
            </div>
            @foreach ($requests as $request)
                <x-bladewind::card>
                    <div class="space-y-1">
                        <x-link href="{{ route('requests.show', $request->id) }}">
                            <h2 class="font-semibold text-xl leading-tight">{{ $request->title }}</h2>
                        </x-link>
                        <p>{{ Auth()->user() && Auth()->user()->id == $request->user->id ? 'Опубликовано вами' : $request->user->name }}</p>
                        <p>{{ $request->is_closed ? 'Закрыто' : 'Открыто' }}</p>
                        <p class="text-gray-500">Было создано {{ $request->created_at->locale('ru')->diffForHumans() }}</p>
                    </div>
                </x-bladewind::card>
            @endforeach
            {{ $requests->links() }}
        @endauth
    </div>
</x-app-layout>
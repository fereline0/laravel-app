<x-app-layout>
    <div class="space-y-4">
        <form method="GET" action="{{ route('welcome') }}">
            <x-bladewind::input type="text" name="search" placeholder="Введите поисковый запрос"
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
                    <p>{{ $announcement->user->name }}</p>
                    <p>{{ $announcement->created_at->locale('ru')->diffForHumans() }}</p>
                </div>
            </x-bladewind::card>
        @endforeach
        {{ $announcements->links() }}
    </div>
</x-app-layout>

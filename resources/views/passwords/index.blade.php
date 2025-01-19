<x-dashboard-layout>
    <div class="space-y-4">
        <form method="GET" action="{{ route('dashboard.passwords.index') }}">
            <x-bladewind::input type="text" name="search" label="Поисковый запрос" value="{{ request('search') }}"
                class="rounded-md" />
            <x-bladewind::select name="sort" :data="$sortOptions" placeholder="Сортировка"
                selected_value="{{ request('sort') }}" />
            <x-bladewind::button can_submit="true">Поиск</x-bladewind::button>
        </form>
        <div class="flex justify-end">
            <x-bladewind::button tag="a" href="{{ route('dashboard.passwords.create') }}">Создать
                пароль</x-bladewind::button>
        </div>
        @foreach ($passwords as $password)
            <x-bladewind::card>
                <div class="space-y-1">
                    <x-link href="{{ route('dashboard.passwords.show', $password->id) }}">
                        <h2 class="font-semibold text-xl leading-tight">{{ $password->source }}</h2>
                    </x-link>
                    <p>{{ Auth()->user()->id == $password->user->id ? 'Опубликовано вами' : $password->user->name }}
                    </p>
                    <p>{{ $password->created_at->locale('ru')->diffForHumans() }}</p>
                </div>
            </x-bladewind::card>
        @endforeach
        {{ $passwords->links() }}
    </div>
</x-dashboard-layout>

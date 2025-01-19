<x-dashboard-layout>
    <div class="space-y-4">
        <form method="GET" action="{{ route('dashboard.cabinets.index') }}">
            <x-bladewind::input type="text" name="search" label="Поисковый запрос" value="{{ request('search') }}"
                class="rounded-md" />
            <x-bladewind::select name="sort" :data="$sortOptions" placeholder="Сортировка"
                selected_value="{{ request('sort') }}" />
            <x-bladewind::button can_submit="true">Поиск</x-bladewind::button>
        </form>

        @can('create cabinet')
            <div class="flex justify-end">
                <x-bladewind::button tag="a" href="{{ route('dashboard.cabinets.create') }}">Создать
                    кабинет</x-bladewind::button>
            </div>
        @endcan

        @foreach ($cabinets as $cabinet)
            <x-bladewind::card>
                <div class="flex justify-between gap-4">
                    <div class="space-y-1">
                        <h2 class="font-semibold text-xl leading-tight">{{ $cabinet->name }}</h2>
                        <p>Было создано {{ $cabinet->created_at->locale('ru')->diffForHumans() }}</p>
                    </div>
                    @canany(['edit cabinet', 'delete cabinet'])
                        <x-bladewind::dropmenu>
                            @can('edit cabinet')
                                <a href="{{ route('dashboard.cabinets.edit', $cabinet->id) }}">
                                    <x-bladewind::dropmenu-item>Изменить</x-bladewind::dropmenu-item>
                                </a>
                            @endcan
                            @can('delete cabinet')
                                <x-bladewind::dropmenu-item
                                    onclick="showModal('delete-{{ $cabinet->id }}')">Удалить</x-bladewind::dropmenu-item>
                            @endcan
                        </x-bladewind::dropmenu>
                    @endcanany
                </div>
            </x-bladewind::card>

            @can('delete cabinet')
                <x-bladewind::modal type="error" title="Вы уверены, что хотите удалить данный кабинет?"
                    name="delete-{{ $cabinet->id }}" show_action_buttons="false">
                    Данное действие необратимо, восстановить кабинет после удаления будет невозможно.
                    <form class="flex justify-end" method="POST"
                        action="{{ route('dashboard.cabinets.destroy', $cabinet->id) }}">
                        @csrf
                        @method('DELETE')
                        <x-bladewind::button can_submit="true" color="red">Удалить</x-bladewind::button>
                    </form>
                </x-bladewind::modal>
            @endcan
        @endforeach

        {{ $cabinets->links() }}
    </div>
</x-dashboard-layout>

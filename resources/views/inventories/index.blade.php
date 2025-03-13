<x-dashboard-layout>
    <div class="space-y-4">
        <form method="GET" action="{{ route('dashboard.inventories.index') }}">
            <x-bladewind::select name="device_id" label="Устройство" :data="$devices" placeholder="Все устройства"
                selected_value="{{ request('device_id') }}" />
            <x-bladewind::select name="cabinet_id" label="Кабинет" :data="$cabinets" placeholder="Все кабинеты"
                selected_value="{{ request('cabinet_id') }}" />
            <x-bladewind::select name="sort" label="Сортировка" :data="$sortOptions" placeholder="Выберите сортировку"
                selected_value="{{ request('sort') }}" />
            <x-bladewind::button can_submit="true">Фильтровать</x-bladewind::button>
        </form>

        <div class="flex justify-end items-center">
            <x-bladewind::button tag="a" href="{{ route('dashboard.inventories.create') }}">Создать
                инвенторизацию</x-bladewind::button>
        </div>

        @foreach ($inventories as $inventory)
            <x-bladewind::card>
                <div class="flex justify-between gap-4">
                    <div class="space-y-1">
                        <h2 class="font-semibold text-xl leading-tight">{{ $inventory->device->name }}</h2>
                        <p>Количество: {{ $inventory->quantity }}</p>
                        <p>Кабинет: {{ $inventory->cabinet->name }}</p>
                        <p class="text-gray-500">Было создано {{ $request->created_at->locale('ru')->diffForHumans() }}</p>
                    </div>
                    @canany(['edit inventory', 'delete inventory'])
                        <x-bladewind::dropmenu>
                            @can('edit inventory')
                                <a href="{{ route('dashboard.inventories.edit', $inventory->id) }}">
                                    <x-bladewind::dropmenu-item>Изменить</x-bladewind::dropmenu-item>
                                </a>
                            @endcan
                            @can('delete inventory')
                                <x-bladewind::dropmenu-item
                                    onclick="showModal('delete-{{ $inventory->id }}')">Удалить</x-bladewind::dropmenu-item>
                            @endcan
                        </x-bladewind::dropmenu>
                    @endcanany
                </div>
            </x-bladewind::card>

            @can('delete inventory')
                <x-bladewind::modal type="error" title="Вы уверены, что хотите удалить данную инвенторизацию?"
                    name="delete-{{ $inventory->id }}" show_action_buttons="false">
                    Данное действие необратимо, восстановить инвентарь после удаления будет невозможно.
                    <form class="flex justify-end" method="POST"
                        action="{{ route('dashboard.inventories.destroy', $inventory->id) }}">
                        @csrf
                        @method('DELETE')

                        <x-bladewind::button can_submit="true" color="red">Удалить</x-bladewind::button>
                    </form>
                </x-bladewind::modal>
            @endcan
        @endforeach

        {{ $inventories->links() }}
    </div>
</x-dashboard-layout>

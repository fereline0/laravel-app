<x-dashboard-layout>
    <div class="space-y-4">
        <form method="GET" action="{{ route('dashboard.devices.index') }}">
            <x-bladewind::input type="text" name="search" label="Поисковый запрос" value="{{ request('search') }}"
                class="rounded-md" />
            <x-bladewind::select name="sort" :data="$sortOptions" placeholder="Сортировка"
                selected_value="{{ request('sort') }}" />
            <x-bladewind::button can_submit="true">Поиск</x-bladewind::button>
        </form>

        <div class="flex justify-end">
            <x-bladewind::button tag="a" href="{{ route('dashboard.devices.create') }}">Создать
                устройство</x-bladewind::button>
        </div>

        @foreach ($devices as $device)
            <x-bladewind::card>
                <div class="flex justify-between gap-4">
                    <div class="space-y-1">
                        <h2 class="font-semibold text-xl leading-tight">{{ $device->name }}</h2>
                        <p>Серийный номер: {{ $device->serial_number }}</p>
                        <p>Дата покупки: {{ $device->purchase_date->format('d.m.Y') }}</p>
                        <p>Цена: <strong>{{ number_format($device->price, 2, ',', ' ') }} ₽</strong></p>
                    </div>
                    @canany(['edit device', 'delete device'])
                        <x-bladewind::dropmenu>
                            @can('edit device')
                                <a href="{{ route('dashboard.devices.edit', $device->id) }}">
                                    <x-bladewind::dropmenu-item>Изменить</x-bladewind::dropmenu-item>
                                </a>
                            @endcan
                            @can('delete device')
                                <x-bladewind::dropmenu-item
                                    onclick="showModal('delete-{{ $device->id }}')">Удалить</x-bladewind::dropmenu-item>
                            @endcan
                        </x-bladewind::dropmenu>
                    @endcanany
                </div>
            </x-bladewind::card>

            @can('delete device')
                <x-bladewind::modal type="error" title="Вы уверены, что хотите удалить данное устройство?"
                    name="delete-{{ $device->id }}" show_action_buttons="false">
                    Данное действие необратимо, восстановить устройство после удаления будет невозможно.
                    <form class="flex justify-end" method="POST"
                        action="{{ route('dashboard.devices.destroy', $device->id) }}">
                        @csrf
                        @method('DELETE')
                        <x-bladewind::button can_submit="true" color="red">Удалить</x-bladewind::button>
                    </form>
                </x-bladewind::modal>
            @endcan
        @endforeach

        {{ $devices->links() }}
    </div>
</x-dashboard-layout>

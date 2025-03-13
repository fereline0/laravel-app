<x-app-layout>
    <x-bladewind::card>
        <div class="flex justify-between gap-4">
            <div class="space-y-1">
                <h2 class="font-semibold text-xl leading-tight">{{ $request->title }}</h2>
                <p>{{ Auth()->user()->id == $request->user->id ? 'Опубликовано вами' : $request->user->name }}</p>
                <p class="text-gray-500">Было создано {{ $request->created_at->locale('ru')->diffForHumans() }}</p>
                <p>{{ $request->is_closed ? 'Закрыто' : 'Открыто' }}</p>
                <p>{{ $request->value }}</p>
            </div>
            <div class="flex">
                @canany(['edit request status', 'delete request'])
                    <x-bladewind::dropmenu>
                        @can('edit request status')
                            <x-bladewind::dropmenu-item onclick="showModal('toggle-status-{{ $request->id }}')">
                                {{ $request->is_closed ? 'Открыть' : 'Закрыть' }}
                            </x-bladewind::dropmenu-item>
                        @endcan
                        @can('delete request')
                            <x-bladewind::dropmenu-item onclick="showModal('delete-{{ $request->id }}')">Удалить</x-bladewind::dropmenu-item>
                        @endcan
                    </x-bladewind::dropmenu>
                @endcanany
            </div>
        </div>
    </x-bladewind::card>

    @can('edit request status')
        <x-bladewind::modal type="info" title="Изменить статус обращения" name="toggle-status-{{ $request->id }}" show_action_buttons="false">
            <p>Вы уверены, что хотите {{ $request->is_closed ? 'открыть' : 'закрыть' }} данное обращение?</p>
            <form method="POST" action="{{ route('dashboard.requests.toggleStatus', $request->id) }}">
                @csrf
                <div class="flex justify-end">
                    <x-bladewind::button can_submit="true" color="blue">Подтвердить</x-bladewind::button>
                </div>
            </form>
        </x-bladewind::modal>
    @endcan

    @can('delete request')
        <x-bladewind::modal type="error" title="Вы уверены, что хотите удалить данное обращение?" name="delete-{{ $request->id }}"
            show_action_buttons="false">
            Данное действие необратимо, восстановить обращение после удаления будет невозможно.
            <form class="flex justify-end" method="POST" action="{{ route('dashboard.requests.destroy', $request->id) }}">
                @csrf
                @method('DELETE')

                <x-bladewind::button can_submit="true" color="red">Удалить</x-bladewind::button>
            </form>
        </x-bladewind::modal>
    @endcan
</x-app-layout>
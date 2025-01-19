<x-app-layout>
    <x-bladewind::card>
        <div class="flex justify-between gap-4">
            <div class="space-y-1">
                <h2 class="font-semibold text-xl leading-tight">{{ $announcement->title }}</h2>
                <p>{{ $announcement->user->name }}</p>
                <p>{{ $announcement->created_at->locale('ru')->diffForHumans() }}</p>
                <p>{{ $announcement->value }}</p>
            </div>
            @canany(['edit announcement', 'delete announcement'])
                <x-bladewind::dropmenu>
                    @can('edit announcement')
                        <a href="{{ route('dashboard.announcements.edit', $announcement->id) }}">
                            <x-bladewind::dropmenu-item>Изменить</x-bladewind::dropmenu-item>
                        </a>
                    @endcan
                    @can('delete announcement')
                        <x-bladewind::dropmenu-item onclick="showModal('delete')">Удалить</x-bladewind::dropmenu-item>
                    @endcan
                </x-bladewind::dropmenu>
            @endcanany
        </div>
    </x-bladewind::card>
</x-app-layout>
@can('delete announcement')
    <x-bladewind::modal type="error" title="Вы уверены, что хотите удалить данное объявление?" name="delete"
        show_action_buttons="false">
        Данное действие необратимо, восстановить объявление после удаления будет невозможно.
        <form class="flex justify-end" method="POST"
            action="{{ route('dashboard.announcements.destroy', $announcement->id) }}">
            @csrf
            @method('DELETE')

            <x-bladewind::button can_submit="true" color="red">Удалить</x-bladewind::button>
        </form>
    </x-bladewind::modal>
@endcan

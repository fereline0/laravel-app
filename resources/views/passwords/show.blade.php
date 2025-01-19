<x-dashboard-layout>
    <x-bladewind::card>
        <div class="flex justify-between gap-4">
            <div class="space-y-1">
                <h2 class="font-semibold text-xl leading-tight">{{ $password->source }}</h2>
                <p>{{ Auth()->user()->id == $password->user->id ? 'Вы' : $password->user->name }}</p>
                <p class="text-gray-500">{{ $password->created_at->locale('ru')->diffForHumans() }}</p>
                <p onclick="copyToClipboard('{{ $password->value }}')" class="blur-md cursor-pointer select-none">
                    {{ $password->value }}</p>
            </div>
            <x-bladewind::dropmenu>
                <a href="{{ route('dashboard.passwords.edit', $password->id) }}">
                    <x-bladewind::dropmenu-item>Изменить</x-bladewind::dropmenu-item>
                </a>
                <x-bladewind::dropmenu-item onclick="showModal('delete')">Удалить</x-bladewind::dropmenu-item>
            </x-bladewind::dropmenu>
        </div>
    </x-bladewind::card>
</x-dashboard-layout>

<x-bladewind::modal type="error" title="Вы уверены, что хотите удалить данный пароль?" name="delete"
    show_action_buttons="false">
    Данное действие необратимо, восстановить пароль после удаления будет невозможно.
    <form class="flex justify-end" method="POST" action="{{ route('dashboard.passwords.destroy', $password->id) }}">
        @csrf
        @method('DELETE')

        <x-bladewind::button can_submit="true" color="red">Удалить</x-bladewind::button>
    </form>
</x-bladewind::modal>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            showNotification('Успешно', 'Пароль успешно копирован в буфер обмена');
        }).catch(err => {
            showNotification('Критическая ошибка',
                'Произошла критическая ошибка при попытке скопировать пароль в буфер обмена', 'error');
        });
    }
</script>

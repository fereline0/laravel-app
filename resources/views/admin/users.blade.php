<x-admin-layout>
    <div class="space-y-4">
        <div class="grid grid-cols-[repeat(auto-fill,minmax(280px,1fr))] gap-2">
            <x-card>
                <h3 class="font-semibold text-lg dark:text-white">Зарегистрировано сегодня</h3>
                <h1 class="text-3xl dark:text-white">{{ $registeredTodayCount }}</h1>
            </x-card>
            <x-card>
                <h3 class="font-semibold text-lg dark:text-white">Пользователей всего</h3>
                <h1 class="text-3xl dark:text-white">{{ $totalUsersCount }}</h1>
            </x-card>
        </div>

        <div>
            <form method="GET" action="{{ route('admin.users') }}" class="flex items-center gap-2">
                <x-text-input type="text" name="search" placeholder="Поиск по имени или email"
                    class="block w-full" />
                <x-primary-button type="submit">Поиск</x-primary-button>
            </form>
        </div>

        <div class="space-y-4">
            @foreach ($users as $user)
                <x-card class="flex flex-wrap gap-4 justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                            <x-link href="{{ route('users.show', $user->id) }}">{{ $user->name }}</x-link>
                        </h3>
                        <p class="dark:text-white">{{ $user->email }}</p>
                        <p class="dark:text-white">{{ $user->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    @if (auth()->user()->can('edit users') || auth()->user()->can('delete users'))
                        <div class="flex gap-2">
                            @can('edit users')
                                <form action="{{ route('users.edit.general', $user->id) }}" method="GET">
                                    <x-primary-button type="submit">Редактировать</x-primary-button>
                                </form>
                            @endcan

                            @can('delete users')
                                <x-danger-button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{ $user->id }}')">Удалить</x-danger-button>
                            @endcan
                        </div>
                    @endif
                </x-card>

                @can('delete users')
                    <x-modal name="confirm-user-deletion-{{ $user->id }}" focusable>
                        <form method="post" action="{{ route('users.destroy', $user->id) }}" class="p-6">
                            @csrf
                            @method('DELETE')

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Вы уверены, что хотите удалить этого пользователя?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('После удаления пользователь будет безвозвратно удален.') }}
                            </p>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Отменить') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Удалить пользователя') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                @endcan
            @endforeach
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>

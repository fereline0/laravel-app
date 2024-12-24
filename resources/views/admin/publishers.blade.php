<x-admin-layout>
    <div class="space-y-4">
        <div class="flex justify-end">
            @can('create publishers')
                <form action="{{ route('publishers.create') }}" method="GET">
                    <x-primary-button type="submit">Создать</x-primary-button>
                </form>
            @endcan
        </div>
        @foreach ($publishers as $publisher)
            <x-card class="flex flex-wrap gap-4 justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        <x-link href="{{ route('publishers.show', $publisher->id) }}">{{ $publisher->name }}</x-link>
                    </h3>
                    <p class="dark:text-white">{{ $publisher->created_at->format('d.m.Y H:i') }}</p>
                </div>
                @if (auth()->user()->can('edit publishers') || auth()->user()->can('delete publishers'))
                    <div class="flex gap-2">
                        @can('edit publishers', $publisher)
                            <form action="{{ route('publishers.edit', $publisher->id) }}" method="GET">
                                <x-primary-button type="submit">Редактировать</x-primary-button>
                            </form>
                        @endcan
                        @can('delete publishers', $publisher)
                            <x-danger-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-publisher-deletion-{{ $publisher->id }}')">Удалить</x-danger-button>
                        @endcan
                    </div>
                @endif
            </x-card>

            @can('delete publishers', $publisher)
                <x-modal name="confirm-publisher-deletion-{{ $publisher->id }}" focusable>
                    <form method="post" action="{{ route('publishers.destroy', $publisher->id) }}" class="p-6">
                        @csrf
                        @method('DELETE')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Вы уверены, что хотите удалить это издательство?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('После удаления издательство будет безвозвратно удалено.') }}
                        </p>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Отменить') }}
                            </x-secondary-button>

                            <x-danger-button class="ms-3">
                                {{ __('Удалить издательство') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            @endcan
        @endforeach
        {{ $publishers->links() }}
    </div>
</x-admin-layout>

<x-admin-layout>
    <div class="space-y-4">
        @can('create authors')
            <form class="flex justify-end" action="{{ route('authors.create') }}" method="GET">
                <x-primary-button type="submit">Создать</x-primary-button>
            </form>
        @endcan

        <div>
            <form method="GET" action="{{ route('admin.authors') }}" class="flex items-center space-x-2">
                <x-text-input type="text" value="{{ request('search') }}" name="search"
                    placeholder="Поиск по имени автора" class="block w-full" />
                <x-primary-button type="submit">Поиск</x-primary-button>
            </form>
        </div>

        @foreach ($authors as $author)
            <x-card class="flex flex-wrap gap-4 justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        <x-link href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</x-link>
                    </h3>
                    <p class="dark:text-white">{{ $author->created_at->format('d.m.Y H:i') }}</p>
                </div>
                @if (auth()->user()->can('edit authors') || auth()->user()->can('delete authors'))
                    <div class="flex gap-2">
                        <form action="{{ route('authors.edit', $author->id) }}" method="GET">
                            <x-primary-button type="submit">Редактировать</x-primary-button>
                        </form>
                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-author-deletion-{{ $author->id }}')">Удалить</x-danger-button>
                    </div>
                @endif
            </x-card>

            @can('delete authors')
                <x-modal name="confirm-author-deletion-{{ $author->id }}" focusable>
                    <form method="post" action="{{ route('authors.destroy', $author->id) }}" class="p-6">
                        @csrf
                        @method('DELETE')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Вы уверены, что хотите удалить этого автора?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('После удаления автор будет безвозвратно удален.') }}
                        </p>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Отменить') }}
                            </x-secondary-button>

                            <x-danger-button class="ms-3">
                                {{ __('Удалить автора') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            @endcan
        @endforeach
        {{ $authors->links() }}
    </div>
</x-admin-layout>

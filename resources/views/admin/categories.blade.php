<x-admin-layout>
    <div class="space-y-4">
        @can('create categories')
            <form class="flex justify-end" action="{{ route('categories.create') }}" method="GET">
                <x-primary-button type="submit">Создать</x-primary-button>
            </form>
        @endcan

        <div>
            <form method="GET" action="{{ route('admin.categories') }}" class="flex items-center gap-2">
                <x-text-input type="text" value="{{ request('search') }}" name="search"
                    placeholder="Поиск по имени категории" class="block w-full" />
                <x-primary-button type="submit">Поиск</x-primary-button>
            </form>
        </div>

        @foreach ($categories as $category)
            <x-card class="flex flex-wrap gap-4 justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        <x-link href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</x-link>
                    </h3>
                    <p class="dark:text-white">{{ $category->created_at->format('d.m.Y H:i') }}</p>
                </div>
                @if (auth()->user()->can('edit categories') || auth()->user()->can('delete categories'))
                    <div class="flex gap-2">
                        <form action="{{ route('categories.edit', $category->id) }}" method="GET">
                            <x-primary-button type="submit">Редактировать</x-primary-button>
                        </form>
                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-category-deletion-{{ $category->id }}')">Удалить</x-danger-button>
                    </div>
                @endif
            </x-card>

            <x-modal name="confirm-category-deletion-{{ $category->id }}" focusable>
                <form method="post" action="{{ route('categories.destroy', $category->id) }}" class="p-6">
                    @csrf
                    @method('DELETE')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Вы уверены, что хотите удалить эту категорию?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('После удаления категория будет безвозвратно удалена.') }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Отменить') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Удалить категорию') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        @endforeach
        {{ $categories->links() }}
    </div>
</x-admin-layout>

<x-admin-layout>
    <div class="space-y-4">
        <div class="flex justify-end">
            @can('create books')
                <form action="{{ route('books.create') }}" method="GET">
                    <x-primary-button type="submit">Создать</x-primary-button>
                </form>
            @endcan
        </div>

        <div>
            <form method="GET" action="{{ route('admin.books') }}" class="flex items-center space-x-2">
                <x-text-input type="text" name="search" placeholder="Поиск по названию книги" class="block w-full" />
                <x-primary-button type="submit">Поиск</x-primary-button>
            </form>
        </div>

        @foreach ($books as $book)
            <x-card class="flex flex-wrap gap-4 justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        <x-link href="{{ route('books.show', $book->id) }}">{{ $book->title }}</x-link>
                    </h3>
                    <p class="dark:text-white">{{ $book->created_at->format('d.m.Y H:i') }}</p>
                </div>
                @if (auth()->user()->can('edit books') || auth()->user()->can('delete books'))
                    <div class="flex gap-2">
                        @can('edit books', $book)
                            <form action="{{ route('books.edit', $book->id) }}" method="GET">
                                <x-primary-button type="submit">Редактировать</x-primary-button>
                            </form>
                        @endcan
                        @can('delete books', $book)
                            <x-danger-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion-{{ $book->id }}')">Удалить</x-danger-button>
                        @endcan
                    </div>
                @endif
            </x-card>

            @can('delete books')
                <x-modal name="confirm-book-deletion-{{ $book->id }}" focusable>
                    <form method="post" action="{{ route('books.destroy', $book->id) }}" class="p-6">
                        @csrf
                        @method('DELETE')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Вы уверены, что хотите удалить эту книгу?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('После удаления книга будет безвозвратно удалена.') }}
                        </p>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Отменить') }}
                            </x-secondary-button>

                            <x-danger-button class="ms-3">
                                {{ __('Удалить книгу') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            @endcan
        @endforeach
        {{ $books->links() }}
    </div>
</x-admin-layout>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 space-y-6">
            <div class="flex text-nowrap overflow-x-auto gap-4">
                @foreach ($categories as $category)
                    <x-link href="{{ route('categories.show', $category->id) }}">
                        <x-card>{{ $category->name }}</x-card>
                    </x-link>
                @endforeach
            </div>

            <form method="GET" action="{{ route('home') }}" class="flex flex-wrap gap-4">
                <x-text-input name="search" placeholder="Поиск по названию" value="{{ request('search') }}" />
                <x-select name="sort">
                    <option value="">Сортировать по</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Возрастанию цены
                    </option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Убыванию цены</option>
                </x-select>
                <x-text-input type="number" name="max_price" placeholder="Макс. цена"
                    value="{{ request('max_price') }}" />
                <x-primary-button type="submit">Применить</x-primary-button>
            </form>

            <div class="grid grid-cols-[repeat(auto-fill,minmax(240px,1fr))] gap-2">
                @foreach ($books as $book)
                    <x-card>
                        @if (!!$book->image)
                            <div class="flex justify-center">
                                <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}">
                            </div>
                        @endif
                        <h3 class="text-lg font-semibold">
                            <x-link href="{{ route('books.show', $book->id) }}">{{ $book->title }}</x-link>
                        </h3>
                        <p class="font-bold dark:text-white">{{ number_format($book->price, 2, ',', ' ') }} ₽</p>
                        <x-link
                            href="{{ route('authors.show', $book->author->id) }}">{{ $book->author->name }}</x-link>
                    </x-card>
                @endforeach
            </div>
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>

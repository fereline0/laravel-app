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
            <h2 class="font-semibold text-2xl">{{ $currentCategory->name }}</h2>
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
                        <x-link href="{{ route('authors.show', $book->author->id) }}">{{ $book->author->name }}</x-link>
                    </x-card>
                @endforeach
            </div>
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
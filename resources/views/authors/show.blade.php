<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-white leading-tight">
            {{ __('Автор') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 space-y-4">
            <x-card>
                <div class="flex flex-col sm:flex-row gap-4">
                    @if (!!$author->image)
                        <div class="flex justify-center">
                            <img class="w-[240px] h-[240px] rounded-lg object-cover"
                                src="{{ Storage::url($author->image) }}" alt="{{ $author->name }}">
                        </div>
                    @endif
                    <div class="w-full flex justify-between gap-4">
                        <div>
                            <h3 class="text-lg dark:text-white font-semibold">{{ $author->name }}</h3>
                            <p class="text-black dark:text-white">{{ $author->description }}</p>
                        </div>
                    </div>
                </div>
            </x-card>
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
                    </x-card>
                @endforeach
            </div>
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>

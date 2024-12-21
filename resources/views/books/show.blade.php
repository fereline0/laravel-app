<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <x-card>
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        @if (!!$book->image)
                        <div class="flex justify-center">
                            <img class="w-[240px] h-[240px] object-cover" src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}">
                        </div>
                        @endif
                        <div class="w-full flex justify-between gap-4">
                            <div>
                                <h3 class="text-lg dark:text-white font-semibold">{{ $book->title }}</h3>
                                <p class="dark:text-white">{{ $book->description }}</p>
                                <x-link href="{{ route('authors.show', $book->author->id) }}">{{ $book->author->name }}</x-link>
                            </div>
                        </div>
                    </div>
                    @auth
                        <div>
                            @if ($book->purchases()->where('user_id', Auth::id())->exists())
                            <form action="{{ route('cart.remove', $book->id) }}" method="POST" class="inline">
                                @csrf
                                <x-danger-button type="submit">Удалить из корзины</x-danger-button>
                            </form>
                            @else
                            <form action="{{ route('cart.add', $book->id) }}" method="POST" class="inline">
                                @csrf
                                <x-primary-button type="submit">Добавить в корзину</x-primary-button>
                            </form>
                            @endif 
                        </div>
                    @endauth
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
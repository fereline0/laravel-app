<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-white leading-tight">
            {{ __('Корзина') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 space-y-6">
            @if ($purchases->isEmpty())
                <p class="dark:text-white text-center">Ваша корзина пуста</p>
            @else
                <div class="grid grid-cols-[repeat(auto-fill,minmax(240px,1fr))] gap-2">
                    @foreach ($purchases as $purchase)
                        <x-card>
                            @if (!!$purchase->book->image)
                                <div class="flex justify-center">
                                    <img src="{{ Storage::url($purchase->book->image) }}"
                                        alt="{{ $purchase->book->title }}">
                                </div>
                            @endif
                            <h3 class="text-lg font-semibold">
                                <x-link
                                    href="{{ route('books.show', $purchase->book->id) }}">{{ $purchase->book->title }}</x-link>
                            </h3>
                            <p class="font-bold dark:text-white">
                                {{ number_format($purchase->book->price, 2, ',', ' ') }} ₽</p>
                            <x-link
                                href="{{ route('authors.show', $purchase->book->author->id) }}">{{ $purchase->book->author->name }}</x-link>
                        </x-card>
                    @endforeach
                </div>
                {{ $purchases->links() }}
            @endif
        </div>
    </div>
</x-app-layout>

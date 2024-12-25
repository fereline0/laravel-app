<x-admin-layout>
    <x-card class="space-y-4">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Редактировать книгу') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Обновите информацию о книге') }}
            </p>
        </div>

        <form method="post" action="{{ route('books.update', $book->id) }}" class="space-y-4"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="title" :value="__('Название книги')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $book->title)"
                    required />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Описание')" />
                <x-textarea id="description" name="description"
                    required>{{ old('description', $book->description) }}</x-textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="author_id" :value="__('Автор')" />
                <x-select id="author_id" name="author_id" class="mt-1 block w-full" required>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>
                            {{ $author->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error class="mt-2" :messages="$errors->get('author_id')" />
            </div>

            <div>
                <x-input-label for="publisher_id" :value="__('Издатель')" />
                <x-select id="publisher_id" name="publisher_id" class="mt-1 block w-full" required>
                    @foreach ($publishers as $publisher)
                        <option value="{{ $publisher->id }}"
                            {{ $publisher->id == $book->publisher_id ? 'selected' : '' }}>{{ $publisher->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error class="mt-2" :messages="$errors->get('publisher_id')" />
            </div>

            <div>
                <x-input-label for="price" :value="__('Цена')" />
                <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full"
                    :value="old('price', $book->price)" required />
                <x-input-error class="mt-2" :messages="$errors->get('price')" />
            </div>

            <div>
                <x-input-label :value="__('Категории')" />
                <div class="mt-2 flex flex-wrap gap-4">
                    @foreach ($categories as $category)
                        <x-checkbox id="category_{{ $category->id }}" name="categories[]" value="{{ $category->id }}"
                            label="{{ $category->name }}" :checked="$book->categories->contains($category->id)" />
                    @endforeach
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('categories')" />
            </div>

            <div>
                <x-input-label for="image" :value="__('Изображение книги')" />
                <x-image-uploader id="image" src="{{ old('image', $book->image) }}" alt="{{ $book->title }}"
                    initials="{{ strtoupper(substr($book->title, 0, 1)) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Обновить') }}</x-primary-button>

                @if (session('status') === 'book-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Книга обновлена') }}</p>
                @endif
            </div>
        </form>
    </x-card>
</x-admin-layout>

<x-admin-layout>
    <x-card class="space-y-4">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Редактировать автора') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Обновите информацию о авторе') }}
            </p>
        </div>

        <form method="post" action="{{ route('authors.update', $author->id) }}" class="space-y-4"
            enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Имя автора')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $author->name)" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Описание автора')" />
                <x-textarea id="description" name="description"
                    class="mt-1 block w-full">{{ old('description', $author->description) }}</x-textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="image" :value="__('Изображение автора')" />
                <x-image-uploader id="image" src="{{ $author->image ? Storage::url($author->image) : null }}"
                    alt="{{ $author->name }}" initials="{{ strtoupper(substr($author->name, 0, 1)) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

                @if (session('status') === 'author-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Автор обновлен') }}</p>
                @endif
            </div>
        </form>

        @if ($author->image)
            <div class="mt-4">
                <x-danger-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-image-deletion-{{ $author->id }}')">
                    {{ __('Удалить изображение') }}
                </x-danger-button>
            </div>
        @endif
    </x-card>

    @if ($author->image)
        <x-modal name="confirm-image-deletion-{{ $author->id }}" focusable>
            <form method="post" action="{{ route('authors.image.delete', $author->id) }}" class="p-6">
                @csrf
                @method('DELETE')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Вы уверены, что хотите удалить это изображение?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('После удаления изображение будет безвозвратно удалено.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Отменить') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Удалить изображение') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endif
</x-admin-layout>

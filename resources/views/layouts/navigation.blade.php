<nav x-data="{ open: false }" class="bg-white dark:bg-black">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="shrink-0 flex items-center">
                <x-link href="{{ route('home') }}">
                    <h2 class="text-xl font-medium">{{ config('app.name', 'Laravel') }}</h2>
                </x-link>
            </div>

            <div class="flex gap-4 items-center ms-6">
                @auth
                    <x-link href="{{ route('admin.users') }}">
                        {{ __('Панель администратора') }}
                    </x-link>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <x-image class="cursor-pointer"
                                src="{{ Auth::user()->detail_information->image ? Storage::url(Auth::user()->detail_information->image) : null }}"
                                alt="{{ Auth::user()->name }}"
                                initials="{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}" />
                        </x-slot>

                        <x-slot name="content">
                            <x-primary-dropdown-link :href="route('users.show', Auth::user()->id)">
                                {{ Auth::user()->name }}
                            </x-primary-dropdown-link>
                            <x-primary-dropdown-link :href="route('users.edit', Auth::user()->id)">
                                {{ __('Редактировать') }}
                            </x-primary-dropdown-link>
                            <x-primary-dropdown-link href="{{ route('cart.index') }}">
                                {{ __('Корзина') }}
                            </x-primary-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-danger-dropdown-link x-on:click.prevent="$dispatch('open-modal', 'confirm-logout')">
                                    {{ __('Выйти') }}
                                </x-danger-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex gap-4">
                        <x-link href="{{ route('login') }}">
                            {{ __('Вход') }}
                        </x-link>
                        <x-link href="{{ route('register') }}">
                            {{ __('Регистрация') }}
                        </x-link>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<x-modal name="confirm-logout" :show="false" focusable>
    <form method="POST" action="{{ route('logout') }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Вы уверены, что хотите выйти?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Вы будете выведены из своей учетной записи. Вы уверены, что хотите продолжить?') }}
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Отменить') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" type="submit">
                {{ __('Выйти') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-white leading-tight">
            {{ __('Пользователь') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <x-card>
                <div class="flex flex-col sm:flex-row gap-4">
                    @if (!!$user->detail_information->image)
                    <div class="flex justify-center">
                        <img class="w-[240px] h-[240px] rounded-lg object-cover" src="{{ Storage::url($user->detail_information->image) }}" alt="{{ $user->name }}">
                    </div>
                    @endif
                    <div class="w-full flex justify-between gap-4">
                        <div>
                            <h3 class="text-lg dark:text-white font-semibold">{{ $user->name }}</h3>
                            @if ($user->detail_information)
                            <p class="text-black dark:text-white">{{ $user->detail_information->about }}</p>

                            @if ($user->detail_information->birthday)
                            <p class="text-black dark:text-white">
                                {{
                                \Carbon\Carbon::parse($user->detail_information->birthday)->locale('ru')->translatedFormat('j
                                F Y')
                                }}
                            </p>
                            @endif

                            @if ($user->detail_information->gender)
                            <p class="text-black dark:text-white">
                                {{ $user->get_gender_display_attribute() }}
                            </p>
                            @endif

                            @if ($user->detail_information->phone_number)
                            <div>
                                <x-link :href="'tel:' . $user->detail_information->phone_number">
                                    {{ $user->detail_information->phone_number }}
                                </x-link>
                            </div>
                            @endif

                            @if ($user->email)
                            <div>
                                <x-link :href="'mailto:' . $user->email">
                                    {{ $user->email }}
                                </x-link>
                            </div>
                            @endif
                            @endif
                        </div>
                        <div>
                            @can('edit', $user)
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <x-primary-button>{{ __('Действия') }}</x-primary-button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-primary-dropdown-link :href="route('users.edit', $user->id)">
                                        {{ __('Редактировать') }}
                                    </x-primary-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            @endcan
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
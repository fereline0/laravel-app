<nav class= "bg-white/70 backdrop-blur border-b top-0 sticky z-30 border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between h-16">
            <div class="flex gap-4">
                <div class="shrink-0 flex items-center">
                    <x-link href="{{ route('welcome') }}">
                        <h2 class="font-semibold text-center text-xl leading-tight">
                            {{ config('app.name', 'Laravel') }}
                        </h2>
                    </x-link>
                </div>
            </div>

            <div class="flex items-center flex-wrap gap-4">
                @auth
                    @if (Auth::user()->hasAnyPermission([
                            'create announcement',
                            'edit announcement',
                            'delete announcement',
                            'create password',
                            'edit password',
                            'delete password',
                            'create device',
                            'edit device',
                            'delete device',
                            'create category',
                            'edit category',
                            'delete category',
                            'create inventory',
                            'edit inventory',
                            'delete inventory',
                            'create cabinet',
                            'edit cabinet',
                            'delete cabinet',
                        ]))
                        <x-link href="{{ route('dashboard.announcements.index') }}">Панель управления</x-link>
                    @endif
                    <x-bladewind::button onclick="showModal('logOut')">Выйти</x-bladewind::button>
                @else
                    <x-link href="{{ route('register') }}">Регистрация</x-link>
                    <x-bladewind::button tag="a" href="{{ route('login') }}">Вход</x-bladewind::button>
                @endauth
            </div>
        </div>
    </div>
</nav>

@auth
    <x-bladewind::modal type="warning" title="Вы уверены, что хотите выйти из учетной записи?" name="logOut"
        show_action_buttons="false">
        Для повторного доступа к приватным маршрутам вам будет необходимо войти в свою учетную запись снова.
        <form class="flex justify-end" method="POST" action="{{ route('logout') }}">
            @csrf

            <x-bladewind::button tag="a" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        this.closest('form').submit();"
                color="yellow">Выйти из учетной записи</x-bladewind::button>
        </form>
    </x-bladewind::modal>
@endauth

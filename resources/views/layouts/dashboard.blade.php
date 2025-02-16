<x-app-layout>
    <div class="space-y-4">
        <div class="bg-white/70 overflow-hidden sticky top-20 z-30 backdrop-blur rounded-lg">
            <x-bladewind::tab-group name="tabs">
            <x-slot:headings>
                @foreach ($tabs as $tab)
                <x-bladewind::tab-heading url="{{ route($tab['url']) }}"
                    active="{{ request()->routeIs($tab['url']) }}" label="{{ $tab['label'] }}" />
                @endforeach
            </x-slot:headings>
        </x-bladewind::tab-group>
        </div>
        {{ $slot }}
    </div>
</x-app-layout>
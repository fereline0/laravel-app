<x-app-layout>
    <div class="space-y-4">
        <x-bladewind::tab-group name="tabs" style="pills">
            <x-slot:headings>
                @foreach ($tabs as $tab)
                <x-bladewind::tab-heading url="{{ route($tab['url']) }}"
                    active="{{ request()->routeIs($tab['url']) }}" label="{{ $tab['label'] }}" />
                @endforeach
            </x-slot:headings>
        </x-bladewind::tab-group>
        {{ $slot }}
    </div>
</x-app-layout>
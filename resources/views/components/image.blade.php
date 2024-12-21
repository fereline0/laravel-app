<div {{ $attributes->merge(['class' => 'flex items-center justify-center w-10 h-10 bg-gray-300 rounded-full overflow-hidden']) }}>
    @if($src)
        <img src="{{ $src }}" alt="{{ $alt }}" class="w-full h-full object-cover" />
    @else
        <span class="text-sm font-bold text-white">{{ $initials }}</span>
    @endif
</div>
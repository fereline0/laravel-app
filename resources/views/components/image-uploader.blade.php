<div id="{{ $id }}" {{ $attributes->merge(['class' => 'relative flex items-center justify-center w-24 h-24 bg-gray-300 rounded-full overflow-hidden group']) }}>
    <label for="{{ $id }}-input" class="cursor-pointer w-full h-full flex items-center justify-center transition duration-300 ease-in-out hover:bg-gray-400">
        <div class="w-full h-full transition duration-300 ease-in-out group-hover:opacity-50 group-hover:blur-sm">
            @if($src)
                <img src="{{ $src }}" alt="{{ $alt }}" class="w-full h-full object-cover rounded-full" />
            @else
                <span class="flex items-center justify-center w-full h-full rounded-full text-lg font-bold text-white">
                    {{ $initials }}
                </span>
            @endif
        </div>
        <span class="absolute transition-opacity duration-300 ease-in-out opacity-0 group-hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </span>
    </label>
</div>

<input type="file" id="{{ $id }}-input" name="image" accept="image/*" class="hidden" />
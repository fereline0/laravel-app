<a
    {{ $attributes->merge([
        'class' => 'class="inline-flex items-center
                    text-[#3b82f6] hover:text-[#2563eb] focus:outline-none transition
                    ease-in-out duration-150"',
    ]) }}>
    {{ $slot }}
</a>

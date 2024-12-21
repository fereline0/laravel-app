@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 backdrop-blur-xl'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="scale-50"
            x-transition:enter-end="scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="scale-100"
            x-transition:leave-end="scale-50"
            class="absolute z-50 mt-2 {{ $width }} rounded-md {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-md shadow dark:shadow-none {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>

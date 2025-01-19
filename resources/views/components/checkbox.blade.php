<label for="{{ $id }}" class="inline-flex items-center">
    <input id="{{ $id }}" type="checkbox" name="{{ $name }}" value="1"
        class="rounded border-gray-300 text-[#3b82f6] shadow-sm focus:ring-[#3b82f6] hover:ring-[#2563eb] transition ease-in-out duration-150"
        {{ $checked ? 'checked' : '' }}>
    <span class="ms-2 text-sm text-gray-600">{{ $label }}</span>
</label>

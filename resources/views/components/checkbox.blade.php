<label for="{{ $id }}" class="inline-flex items-center">
    <input id="{{ $id }}" type="checkbox" name="{{ $name }}" value="{{ $value }}"
        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
        {{ $checked ? 'checked' : '' }}>
    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ $label }}</span>
</label>
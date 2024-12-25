<select
    {{ $attributes->merge([
        'class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
        focus:border-blue-500 dark:focus:border-blue-600 rounded-md',
    ]) }}>
    {{ $slot }}
</select>

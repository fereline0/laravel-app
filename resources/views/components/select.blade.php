<select {{ $attributes->merge(['class' => 'block w-full border border-gray-300 dark:border-gray-700 
    dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 
    focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md 
    transition ease-in-out duration-300 hover:bg-blue-50 dark:hover:bg-blue-800 
    focus:outline-none']) }}>
    {{ $slot }}
</select>
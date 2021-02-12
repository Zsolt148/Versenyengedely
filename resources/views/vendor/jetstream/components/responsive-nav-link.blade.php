@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-blue-400 font-bold text-base font-medium text-blue-600 dark:text-blue-500 bg-blue-50 dark:bg-gray-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-400 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 hover:border-gray-300 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

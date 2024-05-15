@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-2 mt-2 border-b-2 border-[#C83B1A] text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-[#C83B1A] transition duration-150 ease-in-out  dark:focus:text-white dark:hover:text-white dark:text-gray-200 '
            : 'block px-4 py-2 mt-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out dark:focus:text-white dark:hover:text-white dark:text-gray-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center border-b-2 p-6 border-lime-400 dark:border-lime-400 text-sm font-medium leading-5 text-lime-400 dark:text-lime-400 transition duration-150 ease-in-out'
            : 'flex items-center justify-between p-6 border-b-2 border-transparent text-sm font-medium leading-5 text-[#024333] dark:text-[#E8F0F2] hover:text-lime-400 dark:hover:text-lime-400 hover:border-lime-400 dark:hover:border-lime-400 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

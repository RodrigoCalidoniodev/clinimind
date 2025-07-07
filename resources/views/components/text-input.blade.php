@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[#242e15] dark:border-gray-700 bg-zinc-200 dark:bg-[#1C2B2D] dark:text-gray-300 focus:border-[#A6D297] dark:focus:border-lime-400 focus:ring-lime-400 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>

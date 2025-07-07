<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-lime-400 dark:bg-lime-400 border border-transparent rounded-md font-semibold text-xs text-[#024333] dark:text-gray-800 uppercase tracking-widest hover:bg-lime-600 hover:text-[#024333] hover:border hover:border-[#024333] dark:hover:bg-white transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-[#024333] dark:text-[#E8F0F2]']) }}>
    {{ $value ?? $slot }}
</label>

@props(['value'])

<label {{ $attributes->merge(['class' => 'block poppins-light font-normal text-md  text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>

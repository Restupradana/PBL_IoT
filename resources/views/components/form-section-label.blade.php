@props(['for'])

<div {{ $attributes->merge(['class' => 'pt-2']) }}>
    <label for="{{ $for }}" {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
        {{ $slot }}
    </label>
</div>
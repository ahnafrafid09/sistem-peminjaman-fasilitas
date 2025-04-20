@props([
    'type' => 'button',
    'class' => '',
])



<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' => "cursor-pointer inline-flex items-center px-4 justify-center bg-button-primary py-2 border border-transparent rounded-2xl font-semibold text-md text-white uppercase tracking-widest hover:bg-button-primary/80 transition ease-in-out duration-150 $class",
    ]) }}>
    {{ $slot }}
</button>

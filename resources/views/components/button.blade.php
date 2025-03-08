
@php
    $baseClasses = "inline-block px-4 py-1 text-xs font-medium text-white rounded transition duration-200";
    $typeClasses = match($type) {
        'primary' => 'bg-blue-600 hover:bg-blue-700',
        'secondary' => 'bg-gray-600 hover:bg-gray-700',
        'danger' => 'bg-red-600 hover:bg-red-700',
        default => 'bg-blue-600 hover:bg-blue-700'
    };
@endphp

<button class="{{ $baseClasses }} {{ $typeClasses }}">
    {{ $slot }}
</button>

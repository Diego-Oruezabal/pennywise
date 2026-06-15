@props(['type' => 'success', 'message' => ''])

@php

    $colors = [
        'success' => 'bg-green-500',
        'error' => 'bg-red-500',
        'warning' => 'bg-yellow-500',
        'info' => 'bg-blue-500',
    ];

    $class = $colors[$type] ?? $colors['success'];

@endphp

@if($message)

        <p class=" text-white my-2 rounded-lg text-sm p-2 text-center {{ $class }}">
            {{ $message }}
        </p>

@endif

@props(['id', 'maxWidth' => '2xl', 'title' => null])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth ?? '2xl'];
@endphp

<div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail.id === '{{ $id }}') show = true"
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    id="{{ $id }}"
    class="fixed inset-0 flex items-center justify-center z-50 px-4 sm:px-0"
    style="display: none;"
>
    <!-- Fondo -->
    <div x-show="show"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm transition-opacity"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-on:click="show = false">
    </div>

    <!-- Contenido -->
    <div x-show="show"
        class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full {{ $maxWidth }} transform transition-all"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
    >
        <!-- Header -->
        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                {{ $title ?? 'Modal' }}
            </h2>
            <button x-on:click="$dispatch('close-modal')"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                ✕
            </button>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-4">
            {{ $slot }}
        </div>
    </div>
</div>

<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
    [
        'name' => 'Perfil',
        'route' => route('admin.perfil'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
    [
        'name' => 'Certificados',
        'class' => 'text-gray-400 dark:text-white font-semibold',
    ],
]">
    @livewire('certificados.show-certificados')
</x-admin-layout>
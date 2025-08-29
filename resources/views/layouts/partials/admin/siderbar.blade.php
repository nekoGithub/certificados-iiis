@php
    $links = [
        [
            'icon' => 'fa-solid fa-gauge-high',
            'name' => 'Panel Control',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'icon' => 'fa-solid fa-user',
            'name' => 'Perfil',
            'route' => route('admin.perfil'),
            'active' => request()->routeIs('admin.perfil'),
        ],
    ];
@endphp

@php
    $isUsuariosActive = request()->routeIs('lista_usuarios') || request()->routeIs('roles.*');
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': siderbarOpen,
        '-translate-x-full ease-in': !siderbarOpen
    }"
    aria-label="Sidebar">

    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            {{-- Links simples --}}
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['route'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                        <span class="inline-flex w-6 h-6 justify-center items-center">
                            <i class="{{ $link['icon'] }}"></i>
                        </span>
                        <span class="ms-3">{{ $link['name'] }}</span>
                    </a>
                </li>
            @endforeach

            {{-- Dropdown Lista de usuarios --}}

            <li x-data="{ open: {{ $isUsuariosActive ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group
        {{ $isUsuariosActive ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                    <span class="inline-flex w-6 h-6 justify-center items-center">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <span class="ms-3 flex-1 text-left">Lista de usuarios</span>
                    <i :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'" class="ml-auto"></i>
                </button>

                <ul x-show="open" x-transition class="pl-8 mt-1 space-y-1">
                    <li>
                        <a href="{{ route('lista_usuarios') }}"
                            class="flex items-center p-2 text-sm rounded-lg
               {{ request()->routeIs('lista_usuarios') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <i class="fa-solid fa-user me-2"></i> Usuarios
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}"
                            class="flex items-center p-2 text-sm rounded-lg
               {{ request()->routeIs('roles.*') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <i class="fa-solid fa-user-shield me-2"></i> Roles y permisos
                        </a>
                    </li>
                    {{-- <li>
                        <a href=""
                            class="flex items-center p-2 text-sm text-gray-700 rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-lock me-2"></i> Permisos
                        </a>
                    </li> --}}
                </ul>
            </li>

        </ul>
    </div>
</aside>

<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Roles',
        'route' => route('roles.index'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">




    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 p-6">
        {{-- LISTA DE ROLES --}}
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Lista de Roles</h2>



            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#3085d6'
                    });
                @elseif (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: '{{ session('error') }}',
                        confirmButtonColor: '#d33'
                    });
                @endif
            </script>

            <div class="flex justify-end mb-6">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow " x-data
                    x-on:click="$dispatch('open-modal', { id: 'modal-create-role' })">
                    Crear nuevo rol
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 dark:border-gray-700 rounded-lg">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Nombre Rol</th>
                            <th class="px-4 py-2 text-left">Permisos</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $rol)
                            <tr class="border-t dark:border-gray-600">
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $rol->id }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $rol->name }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    @if ($rol->permissions->isNotEmpty())
                                        @foreach ($rol->permissions as $permission)
                                            <span
                                                class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded mr-1 mb-1">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-500 text-sm">Sin permisos</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    {{-- Botón editar --}}
                                    <button
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm"
                                        x-data
                                        x-on:click="$dispatch('open-modal', { id: 'modal-edit-role-{{ $rol->id }}' })">
                                        Editar
                                    </button>

                                    {{-- Botón eliminar --}}
                                    <form action="{{ route('roles.destroy', $rol->id) }}" method="POST"
                                        class="inline delete-role-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $rol->id }}"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal editar rol --}}
                            <x-modal id="modal-edit-role-{{ $rol->id }}">
                                <x-slot name="title">Editar Rol: {{ $rol->name }}</x-slot>
                               <form class="edit-role-form" data-id="{{ $rol->id }}" action="{{ route('roles.update', $rol->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="name" class="block text-sm font-medium ">Nombre del Rol</label>
                                        <input type="text" name="name" value="{{ $rol->name }}"
                                            class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" x-on:click="$dispatch('close-modal')"
                                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                            Cerrar
                                        </button>
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                            Guardar
                                        </button>
                                    </div>
                                </form>
                            </x-modal>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-gray-500">No existen roles
                                    registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREAR ROL --}}
    <x-modal id="modal-create-role">
        <x-slot name="title">Crear nuevo Rol</x-slot>
        <form id="create-role-form" action="{{ route('roles.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="nombre" class="block text-sm font-medium">Nombre del Rol</label>
                <input type="text" id="nombre" name="nombre"
                    class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" x-on:click="$dispatch('close-modal')"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cerrar</button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Guardar</button>
            </div>
        </form>
    </x-modal>

</x-admin-layout>

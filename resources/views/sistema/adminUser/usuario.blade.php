<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Usuarios',
        'route' => route('dashboard'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- 📌 LISTA DE USUARIOS --}}
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Lista de Usuarios</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                Aquí puedes ver los usuarios registrados y administrar sus roles.
            </p>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Nombre</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Correo</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Roles</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-t dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    @if($user->roles->isNotEmpty())
                                        @foreach($user->roles as $rol)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                {{ $rol->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-300 text-gray-800 dark:bg-gray-600 dark:text-gray-200">
                                            Sin roles
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <button
                                        class="text-blue-600 dark:text-blue-400 hover:underline"
                                        x-data
                                        @click="$dispatch('open-modal', { id: 'editRolesModal-{{ $user->id }}' })">
                                        Editar Roles
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL DE ROLES --}}
                            <div x-data="{ open: false }"
                                 x-show="open"
                                 x-on:open-modal.window="if($event.detail.id === 'editRolesModal-{{ $user->id }}'){ open = true }"
                                 x-cloak
                                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">

                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6">
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                        Editar Roles de {{ $user->name }}
                                    </h5>
                                    <form action="{{ route('asignar_rol', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="space-y-2 mb-4">
                                            @foreach($roles as $rol)
                                                <label class="flex items-center space-x-2">
                                                    <input type="checkbox"
                                                        class="rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500"
                                                        name="roles[]"
                                                        value="{{ $rol->name }}"
                                                        @if($user->hasRole($rol->name)) checked @endif>
                                                    <span class="text-gray-800 dark:text-gray-200">{{ $rol->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button"
                                                    class="px-4 py-2 rounded bg-gray-300 text-gray-800 hover:bg-gray-400 dark:bg-gray-600 dark:text-gray-200"
                                                    @click="open = false">
                                                Cerrar
                                            </button>
                                            <button type="submit"
                                                    class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                                                Guardar cambios
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                    No existen usuarios
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 📌 CREAR NUEVO USUARIO --}}
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Crear un nuevo Usuario</h3>
            <form method="POST" action="{{ route('crear_usuario') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nombre de Usuario
                    </label>
                    <input type="text" id="name" name="name"
                           class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ingrese nombre de usuario">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Correo
                    </label>
                    <input type="email" id="email" name="email"
                           class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ingrese correo">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Contraseña
                        </label>
                        <input type="password" id="password" name="password"
                               class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Confirmar contraseña
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <button type="submit"
                            class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                        Enviar
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-admin-layout>

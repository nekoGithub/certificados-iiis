<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Lista de estudiantes',
        'route' => route('dashboard'),
        'class' => 'text-gray-900 dark:text-white font-semibold',
    ],
]">

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">

        {{-- 📌 LISTA DE USUARIOS --}}
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Lista de Estudiantes</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Aquí puede ver la lista de los estudiantes para generar sus certificados
                    </p>
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200"
                    x-data @click="$dispatch('open-modal', { id: 'createModal' })">
                    <i class="fas fa-plus mr-2"></i>Nuevo Estudiante
                </button>
            </div>


            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Nombres</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Apellidos</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Carnet</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Email</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Telefono</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Codigo certificado</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Fecha emisión</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Estado</th>
                            <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-200">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudiantes as $estudiante)
                            <tr class="border-t dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $estudiante->nombres }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $estudiante->apellidos }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $estudiante->ci }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $estudiante->email }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $estudiante->telefono }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->codigo_certificado }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $estudiante->fecha_emision }}
                                </td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $estudiante->estado }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <!-- Botón Editar -->
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded"
                                        @click="$dispatch('open-modal', { id: 'editModal-{{ $estudiante->id }}' })">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button onclick="eliminarEstudiante({{ $estudiante->id }})"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Editar Estudiante -->
                            <div x-data="{ open: false }" x-show="open"
                                x-on:open-modal.window="if ($event.detail.id === 'editModal-{{ $estudiante->id }}') open = true"
                                x-on:keydown.escape.window="open = false" x-cloak
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">

                                <div
                                    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md modal-container">
                                    <div class="p-6">
                                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                            Editar Estudiante
                                        </h5>
                                        <form action="{{ route('estudiantes.update', $estudiante->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium">Nombres</label>
                                                    <input type="text" name="nombres"
                                                        value="{{ $estudiante->nombres }}" required
                                                        class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium">Apellidos</label>
                                                    <input type="text" name="apellidos"
                                                        value="{{ $estudiante->apellidos }}" required
                                                        class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium">Carnet</label>
                                                    <input type="text" name="ci" value="{{ $estudiante->ci }}"
                                                        required
                                                        class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium">Email</label>
                                                    <input type="email" name="email"
                                                        value="{{ $estudiante->email }}"
                                                        class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium">Teléfono</label>
                                                    <input type="text" name="telefono"
                                                        value="{{ $estudiante->telefono }}"
                                                        class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium">Código Certificado</label>
                                                    <input type="text" name="codigo_certificado"
                                                        value="{{ $estudiante->codigo_certificado }}"
                                                        class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium">Fecha Emisión</label>
                                                    <input type="date" name="fecha_emision"
                                                        value="{{ $estudiante->fecha_emision }}"
                                                        class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium">Estado</label>
                                                    <select name="estado"
                                                        class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                                                        <option value="activo"
                                                            {{ $estudiante->estado == 'activo' ? 'selected' : '' }}>
                                                            Activo</option>
                                                        <option value="inactivo"
                                                            {{ $estudiante->estado == 'inactivo' ? 'selected' : '' }}>
                                                            Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="flex justify-end space-x-2 mt-6">
                                                <button type="button"
                                                    class="px-4 py-2 rounded bg-gray-300 text-gray-800 hover:bg-gray-400 dark:bg-gray-600 dark:text-gray-200"
                                                    @click="open = false">
                                                    Cerrar
                                                </button>
                                                <button type="submit"
                                                    class="px-4 py-2 rounded bg-yellow-500 text-white hover:bg-yellow-600">
                                                    Actualizar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <!-- Modal para Crear Estudiante -->
    <div x-data="{ open: false }" x-show="open"
        x-on:open-modal.window="if ($event.detail.id === 'createModal') open = true"
        x-on:keydown.escape.window="open = false" x-cloak
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md modal-container">
            <div class="p-6">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Nuevo Estudiante
                </h5>
                <form id="createForm" action="{{ route('estudiantes.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombres
                                *</label>
                            <input type="text" id="create-nombres" required name="nombres"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            <span id="create-error-nombres" class="text-red-500 text-xs hidden"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Apellidos
                                *</label>
                            <input type="text" id="create-apellidos" required name="apellidos"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            <span id="create-error-apellidos" class="text-red-500 text-xs hidden"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Carnet
                                *</label>
                            <input type="text" id="create-ci" required name="ci"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            <span id="create-error-ci" class="text-red-500 text-xs hidden"></span>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" id="create-email" name="email"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            <span id="create-error-email" class="text-red-500 text-xs hidden"></span>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Teléfono</label>
                            <input type="text" id="create-telefono" name="telefono"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            <span id="create-error-telefono" class="text-red-500 text-xs hidden"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Código
                                Certificado</label>
                            <input type="text" id="create-codigo_certificado" name="codigo_certificado"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            <span id="create-error-codigo_certificado" class="text-red-500 text-xs hidden"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha
                                Emisión</label>
                            <input type="date" id="create-fecha_emision" name="fecha_emision"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            <span id="create-error-fecha_emision" class="text-red-500 text-xs hidden"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado
                                *</label>
                            <select id="create-estado" required name="estado"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                            <span id="create-error-estado" class="text-red-500 text-xs hidden"></span>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button"
                            class="px-4 py-2 rounded bg-gray-300 text-gray-800 hover:bg-gray-400 dark:bg-gray-600 dark:text-gray-200"
                            @click="open = false">
                            Cerrar
                        </button>
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                            Crear
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function eliminarEstudiante(id) {
        Swal.fire({
            title: '¿Seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/estudiantes/${id}`)
                    .then(res => {
                        Swal.fire('Eliminado!', res.data.message, 'success');
                        // Recarga la página o elimina la fila de la tabla
                        setTimeout(() => location.reload(), 1000);
                    })
                    .catch(err => {
                        Swal.fire('Error!', err.response.data.message, 'error');
                    });
            }
        })
    }
</script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function eliminarEstudiante(id) {
            Swal.fire({
                title: '¿Seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/estudiantes/${id}`)
                        .then(res => {
                            Swal.fire('Eliminado!', res.data.message, 'success');
                            // Recarga la página o elimina la fila de la tabla
                            setTimeout(() => location.reload(), 1000);
                        })
                        .catch(err => {
                            Swal.fire('Error!', err.response.data.message, 'error');
                        });
                }
            })
        }
    </script>



</x-admin-layout>

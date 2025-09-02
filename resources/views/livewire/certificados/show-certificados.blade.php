<div wire:init="loadCertificados">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="px-6 py-4 flex items-center">

            <div class="flex items-center dark:text-white">
                <span>Mostrar</span>

                <select wire:model.live="cantidad"
                    class="mx-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <span>Entradas</span>
            </div>

            <x-input type="text" class="flex-1 mx-5" wire:model.live="search"
                placeholder="🔎 Buscar certificado..." />
            @livewire('certificados.create-certificados')
        </div>

        @if (count($certificados))
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('id')">
                            Nro.
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-1-9 float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-up-9-1 float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('nombre')">
                            Nombre
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3">Descripción</th>
                        <th scope="col" class="px-6 py-3">Plantilla</th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('estado')">
                            Estado
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('fecha_inicio')">
                            Fecha Inicio
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('fecha_fin')">
                            Fecha Fin
                        </th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificados as $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $item->id }}
                            </th>
                            <td class="px-6 py-4">{{ $item->nombre }}</td>
                            <td class="px-6 py-4">{{ Str::limit($item->descripcion, 40) }}</td>
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($item->foto) }}" alt="Plantilla"
                                    class="w-20 h-14 object-cover rounded shadow">
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="toggleEstado({{ $item->id }})"
                                    class="px-2 py-1 text-xs font-semibold rounded
            {{ $item->estado == 'activo'
                ? 'bg-green-600 hover:bg-green-700 text-white'
                : 'bg-red-600 hover:bg-red-700 text-white' }}">
                                    {{ ucfirst($item->estado) }}
                                </button>
                            </td>

                            <td class="px-6 py-4">{{ $item->fecha_inicio }}</td>
                            <td class="px-6 py-4">{{ $item->fecha_fin }}</td>
                            <td class="px-6 py-4 flex">


                                <a wire:click="edit({{ $item }})"
                                    class="inline-flex items-center justify-center px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition-colors">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <a onclick="confirmDeleteCertificado({{ $item->id }})"
                                    class="ml-2 inline-flex items-center justify-center px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-500 transition-colors">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>

                                <a href="{{ route('admin.certificados.configurar', $item) }}"
                                    class="ml-2 inline-flex items-center justify-center px-3 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 transition-colors">
                                    <i class="fa-solid fa-award"></i>
                                </a>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($certificados->hasPages())
                <div class="px-6 py-3">
                    {{ $certificados->links() }}
                </div>
            @endif
        @else
            <div class="text-red-400 px-6 py-4">
                No existe ningún certificado registrado!!!
            </div>
        @endif
    </div>

    {{-- Modal de edición --}}
    <x-dialog-modal wire:model="openEdit" maxWidth="2xl">
        <x-slot name="title">
            <h3 class="font-semibold mb-3 text-xl text-center">EDITAR CERTIFICADO</h3>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre" />
                <x-input type="text" wire:model.lazy="certificadoEdit.nombre" class="w-full" />
                <x-input-error for="certificadoEdit.nombre" />
            </div>

            <div class="mb-4">
                <x-label value="Descripción" />
                <textarea wire:model.lazy="certificadoEdit.descripcion" class="w-full rounded border-gray-300"></textarea>
                <x-input-error for="certificadoEdit.descripcion" />
            </div>

            <div class="mb-4">
                <x-label value="Estado" />
                <select wire:model.lazy="certificadoEdit.estado"
                    class="w-full rounded border-gray-300 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
                <x-input-error for="certificadoEdit.estado" />
            </div>

            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <x-label value="Fecha de Inicio" />
                    <x-input type="datetime-local" wire:model.lazy="certificadoEdit.fecha_inicio" class="w-full" />
                    <x-input-error for="certificadoEdit.fecha_inicio" />
                </div>
                <div class="w-1/2">
                    <x-label value="Fecha de Fin" />
                    <x-input type="datetime-local" wire:model.lazy="certificadoEdit.fecha_fin" class="w-full" />
                    <x-input-error for="certificadoEdit.fecha_fin" />
                </div>
            </div>

            <div class="mb-6">
                <x-label value="Plantilla (Foto)" />
                <x-input type="file" wire:model="certificadoEdit.foto" class="w-full cursor-pointer"
                    accept=".png, .jpg" />
                <x-input-error for="certificadoEdit.foto" />

                @if (isset($certificadoEdit['foto']) && is_object($certificadoEdit['foto']))
                    <img src="{{ $certificadoEdit['foto']->temporaryUrl() }}"
                        class="mt-3 w-32 h-24 object-cover rounded shadow">
                @elseif ($certificado?->foto)
                    <img src="{{ Storage::url($certificado->foto) }}"
                        class="mt-3 w-32 h-24 object-cover rounded shadow">
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cancelEdit" class="mr-3">Cancelar</x-secondary-button>
            <x-danger-button class="bg-indigo-700 hover:bg-indigo-500" wire:click="update" wire:loading.remove
                wire:target="update">Actualizar</x-danger-button>
            <div wire:loading wire:target="update" class="text-center">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60" />
            </div>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDeleteCertificado(certificado_id) {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('deleteCertificado', certificado_id);
                    }
                });
            }

            Livewire.on('certificadoDeleted', () => {
                Swal.fire({
                    icon: "success",
                    title: "Certificado eliminado exitosamente",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
        <script>

    Livewire.on('estadoActualizado', () => {
    Swal.fire({
        icon: "success",
        title: "Estado actualizado",
        showConfirmButton: false,
        timer: 1500
    });
});
        </script>
    @endpush


</div>

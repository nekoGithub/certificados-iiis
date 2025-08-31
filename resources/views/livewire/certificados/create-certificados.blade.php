<div>
    <x-button
        class="bg-indigo-700 hover:bg-indigo-500 dark:bg-indigo-700 dark:text-white dark:hover:bg-indigo-500 focus:bg-indigo-700 dark:focus:bg-indigo-700"
        wire:click="create">
        Crear Certificado
    </x-button>

    <x-dialog-modal wire:model="open" wire:ignore.self maxWidth="2xl">
        <x-slot name="title">
            <h3 class="font-semibold mb-3 text-xl text-center">FORMULARIO DE CREACIÓN DE CERTIFICADO</h3>
        </x-slot>

        <x-slot name="content">
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-lg">Datos del Certificado</h3>

                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="Nombre" />
                        <x-input type="text" wire:model="nombre" placeholder="Ej. Curso de Laravel" class="w-full" />
                        <x-input-error for="nombre" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Estado" />
                        <select wire:model="estado"
                            class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                        <x-input-error for="estado" />
                    </div>
                </div>

                <div class="mb-4">
                    <x-label value="Descripción" />
                    <textarea wire:model="descripcion" placeholder="Breve descripción del curso o evento..."
                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    <x-input-error for="descripcion" />
                </div>
            </div>

            <!-- Separador visual -->
            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
                <div class="mx-4 w-3 h-3 bg-indigo-600 rounded-full dark:bg-indigo-400"></div>
                <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
            </div>

            <!-- Fechas -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-lg">Fechas de Habilitación</h3>
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <x-label value="Fecha de Inicio" />
                        <x-input type="datetime-local" wire:model="fecha_inicio" class="w-full" />
                        <x-input-error for="fecha_inicio" />
                    </div>
                    <div class="w-1/2">
                        <x-label value="Fecha de Fin" />
                        <x-input type="datetime-local" wire:model="fecha_fin" class="w-full" />
                        <x-input-error for="fecha_fin" />
                    </div>
                </div>
            </div>

            <!-- Separador visual -->
            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
                <div class="mx-4 w-3 h-3 bg-indigo-600 rounded-full dark:bg-indigo-400"></div>
                <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
            </div>

            <!-- Plantilla -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-lg">Plantilla del Certificado
                    <h2 class="text-sm mb-3 text-indigo-700 dark:text-white">
                        Carga archivos en formato .png o .jpg
                    </h2>
                </h3>

                <div class="flex flex-col items-center justify-center gap-3">
                    <x-input type="file" wire:model="foto" class="w-1/2 cursor-pointer" accept=".png, .jpg, .jpeg" />
                    <x-input-error for="foto" />

                    @if ($foto)
                        <div class="mt-2 text-center">
                            <span class="text-sm text-gray-600 dark:text-white">Vista previa:</span>
                            <div class="mt-1">
                                <img src="{{ $foto->temporaryUrl() }}" alt="Vista previa"
                                    class="rounded shadow-md w-72 h-52 object-cover" />
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mr-3">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="bg-indigo-700 hover:bg-indigo-500" wire:click="save" wire:loading.remove
                wire:target="save,foto">
                Crear Certificado
            </x-danger-button>

            <div wire:loading wire:target="save,foto" class="text-center">
                <img src="{{ asset('img/spinner.svg') }}" alt="Cargando..." width="60" />
            </div>
        </x-slot>
    </x-dialog-modal>
</div>

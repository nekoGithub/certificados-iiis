<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            Configurar Certificado: {{ $certificado->nombre }}
        </h1>
        <p class="text-gray-600 dark:text-gray-300 mt-2">
            Ajusta la posición donde aparecerá el nombre completo en el certificado
        </p>
    </div>

    @if (session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Panel de Configuración -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white">
                Configuración de Posición
            </h2>

            <form wire:submit.prevent="guardarPosicion">
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Slider Top -->
                        <div>
                            <x-label for="top"
                                value="Posición Vertical (Top): reducir → arriba, aumentar → abajo" />
                            <!-- Barra de progreso arriba -->
                            <div class="w-full h-2 bg-gray-300 rounded-full mb-2 overflow-hidden">
                                <div class="h-2 bg-indigo-600" style="width: {{ (($top ?? 260) * 100) / 595 }}%"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <input type="range" id="top" wire:model.live="top" min="0" max="595"
                                    class="w-full h-2 bg-gray-200 rounded-lg accent-indigo-600 cursor-pointer">
                                <span
                                    class="w-12 text-right text-sm font-medium text-gray-700 dark:text-gray-300">{{ $top ?? 260 }}
                                    px</span>
                            </div>
                            <x-input-error for="top" />
                            <p class="text-xs text-gray-500 mt-1">Máximo: 595px</p>
                        </div>

                        <!-- Slider Left -->
                        <div>

                            <x-label for="left"
                                value="Posición Horizontal (Left): reducir → izquierda, aumentar → derecha" />

                            <!-- Barra de progreso arriba -->
                            <div class="w-full h-2 bg-gray-300 rounded-full mb-2 overflow-hidden">
                                <div class="h-2 bg-yellow-600" style="width: {{ (($left ?? 400) * 100) / 842 }}%"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <input type="range" id="left" wire:model.live="left" min="0"
                                    max="842"
                                    class="w-full h-2 bg-gray-200 rounded-lg accent-yellow-600 cursor-pointer">
                                <span
                                    class="w-12 text-right text-sm font-medium text-gray-700 dark:text-gray-300">{{ $left ?? 400 }}
                                    px</span>
                            </div>
                            <x-input-error for="left" />
                            <p class="text-xs text-gray-500 mt-1">Máximo: 842px</p>
                        </div>
                    </div>

                    <div class="text-sm text-gray-600 dark:text-gray-400 bg-blue-50 dark:bg-blue-900 p-3 rounded">
                        <strong>Referencia:</strong> El centro del certificado está en Top: 297px, Left: 421px<br>
                        <strong>Tamaño:</strong> 842px de ancho × 595px de alto (A4 horizontal)
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <a href="{{ route('admin.certificados.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Volver a Certificados
                    </a>

                    <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700">
                        Guardar Posición
                    </x-button>
                </div>
            </form>


        </div>

        <!-- Vista Previa del Certificado -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white">
                Vista Previa
            </h2>

            <!-- Contenedor responsive que mantiene proporciones A4 -->
            <div class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden mx-auto"
                style="width: 100%; max-width: 700px; aspect-ratio: 842/595;">

                <img src="{{ asset('storage/' . $certificado->foto) }}" alt="Certificado {{ $certificado->nombre }}"
                    class="w-full h-full object-contain bg-gray-100">

                <!-- Nombre posicionado dinámicamente (escalado proporcionalmente) -->
                <div id="nombre-preview"
                    class="absolute text-lg font-bold text-black bg-white bg-opacity-90 px-2 py-1 rounded shadow-lg border-2 border-red-500"
                    style="
                        top: {{ (($top ?? 260) * 100) / 595 }}%; 
                        left: {{ (($left ?? 400) * 100) / 842 }}%;
                        transform: translate(-50%, -50%);
                        text-align: center;
                        min-width: 150px;
                        white-space: nowrap;
                        font-size: clamp(12px, 1.5vw, 18px);
                    ">
                    {{ $nombreCompleto }}
                </div>

                <!-- Indicador de posición -->
                <div class="absolute top-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                    Top: {{ $top ?? 260 }}px, Left: {{ $left ?? 400 }}px
                </div>

                <!-- Líneas guía -->
                <div class="absolute inset-0 pointer-events-none" style="z-index: 5;">
                    <!-- Línea vertical en el centro (50%) -->
                    <div class="absolute w-0.5 h-full bg-blue-300 opacity-30" style="left: 50%;"></div>
                    <!-- Línea horizontal en el centro (50%) -->
                    <div class="absolute h-0.5 w-full bg-blue-300 opacity-30" style="top: 50%;"></div>
                </div>
            </div>

            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <p><strong>Vista previa:</strong> {{ $nombreCompleto }}</p>
                <p><strong>Certificado:</strong> {{ $certificado->nombre }}</p>
                <p><strong>Posición real en PDF:</strong> Top {{ $top ?? 260 }}px, Left {{ $left ?? 400 }}px</p>
                <p class="text-red-600 dark:text-red-400">
                    El recuadro rojo muestra la posición exacta en el PDF
                </p>
                <p class="text-blue-600 dark:text-blue-400">
                    Centro del certificado: Top 297px, Left 421px
                </p>
            </div>

            <!-- Botones de Prueba -->
            <div class="mt-6 space-y-2">
                <a href="{{ route('admin.certificados.preview-pdf', $certificado->id) }}?nombre_estudiante={{ urlencode($nombreCompleto) }}"
                    target="_blank"
                    class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded">
                    Ver PDF de Prueba
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Actualizar vista previa en tiempo real
    document.addEventListener('livewire:init', function() {
        Livewire.on('posicion-actualizada', function(data) {
            const elemento = document.getElementById('nombre-preview');
            if (elemento) {
                elemento.style.top = data.top ? data.top + 'px' : '';
                elemento.style.left = data.left ? data.left + 'px' : '';
                elemento.style.right = data.right ? data.right + 'px' : '';
                elemento.style.bottom = data.bottom ? data.bottom + 'px' : '';
            }
        });
    });
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificado - {{ $certificado->nombre }}</title>
    <style>
        @page {
            margin: 0;
            size: letter landscape;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .certificado-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .certificado-imagen {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ajusta la imagen para cubrir toda la hoja */
        }

        .nombre-estudiante {
            position: absolute;
            font-size: 57px;
            font-weight: bold;
            color: #000;
            text-align: center;
            white-space: nowrap;
            z-index: 10;
            min-width: 250px;

            @if($posicion && $posicion->top && $posicion->left)
                top: {{ $posicion->top }}px;
                left: {{ $posicion->left }}px;
            @else
                top: 260px;
                left: 400px;
            @endif
        }
    </style>
</head>
<body>
    <div class="certificado-container">
        <img src="{{ $imagenPath }}" alt="Certificado" class="certificado-imagen">
        <div class="nombre-estudiante">
            {{ $nombreEstudiante }}
        </div>
    </div>
</body>
</html>

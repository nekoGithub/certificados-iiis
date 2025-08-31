<?php

namespace App\Services;

use App\Models\Certificado;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificadoService
{
    public function generarCertificadoPDF(Certificado $certificado, $nombreEstudiante, $topDinamico = null, $leftDinamico = null)
    {
        // Para preview: usar coordenadas dinámicas si se proporcionan
        // Para generación final: usar las guardadas en BD
        $posicion = $certificado->posicion;

        if ($topDinamico !== null && $leftDinamico !== null) {
            // Coordenadas dinámicas (para preview)
            $top = $topDinamico;
            $left = $leftDinamico;
        } else {
            // Coordenadas guardadas (para generación final)
            $top = $posicion->top ?? 260;
            $left = $posicion->left ?? 400;
        }

        $imagenPath = public_path('storage/' . $certificado->foto);

        $html = view('pdf.certificado', [
            'certificado' => $certificado,
            'nombreEstudiante' => $nombreEstudiante,
            'imagenPath' => $imagenPath,
            'posicion' => (object)['top' => $top, 'left' => $left]
        ])->render();

        $pdf = Pdf::loadHTML($html)
            ->setPaper('letter', 'landscape'); // Tamaño carta horizontal;

        return $pdf;
    }
}

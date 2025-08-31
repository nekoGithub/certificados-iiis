<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Services\CertificadoService;
use Illuminate\Http\Request;

class CertificadoController extends Controller
{

    protected $certificadoService;

    public function __construct(CertificadoService $certificadoService)
    {
        $this->certificadoService = $certificadoService;
    }

    public function index()
    {
        return view('admin.certificados.index');
    }

    public function generarPDF(Certificado $certificado, Request $request)
    {
        $nombreEstudiante = $request->input('nombre_estudiante', 'Nombre del Estudiante');

        $pdf = $this->certificadoService->generarCertificadoPDF($certificado, $nombreEstudiante);

        return $pdf->download("certificado_{$certificado->nombre}_{$nombreEstudiante}.pdf");
    }

    public function previewPDF(Certificado $certificado, Request $request)
    {
        $nombreEstudiante = $request->input('nombre_estudiante', 'Vista Previa');

        // Recibir coordenadas dinámicas para la vista previa
        $topDinamico = $request->input('top');
        $leftDinamico = $request->input('left');

        $pdf = $this->certificadoService->generarCertificadoPDF(
            $certificado,
            $nombreEstudiante,
            $topDinamico,
            $leftDinamico
        );

        return $pdf->stream("preview_certificado_{$certificado->id}.pdf");
    }
}

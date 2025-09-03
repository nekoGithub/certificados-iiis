<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\Estudiante;
use App\Services\CertificadoService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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
            $topDinamico + 60,
            $leftDinamico - 140
        );

        return $pdf->stream("preview_certificado_{$certificado->id}.pdf");
    }


    public function estudiantepreviewPDF(Request $request, $id)
    {

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'ci' => 'required',
            'email' => 'required',
            'telefono' => 'required'
        ]);

        $certificadoRaw = DB::table('certificados as ce')
            ->join('posiciones as po', 'ce.id', '=', 'po.certificado_id')
            ->select('top', 'left', 'ce.id')
            ->first();

        if (!$certificadoRaw) {
            return redirect()->back()->with('error', 'No existe certificado!!');
        }

        // convertir a modelo Certificado
        $certificado = Certificado::findOrFail($certificadoRaw->id);

        // le agregamos las coords que vinieron del join
        $certificado->posicion = (object)[
            'top' => $certificadoRaw->top,
            'left' => $certificadoRaw->left,
        ];

        $estudiante = Estudiante::where('ci', $request->ci)->first();

        if (!$estudiante) {
            $estudiante = Estudiante::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'ci' => $request->ci,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'fecha_emision' => $request->fecha_emision,
            ]);
        }


        $nombreEstudiante = $estudiante->nombres . ' ' . $estudiante->apellidos;

        $topDinamico = $certificado->posicion->top;
        $leftDinamico = $certificado->posicion->left;


        $pdf = $this->certificadoService->generarCertificadoPDF(
            $certificado,
            $nombreEstudiante,
            $topDinamico + 60,
            $leftDinamico - 140
        );

        return $pdf->download("preview_certificado_{$nombreEstudiante}.pdf");
    }
}

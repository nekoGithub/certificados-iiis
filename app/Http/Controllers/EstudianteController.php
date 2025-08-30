<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EstudianteController extends Controller
{
    public function listar_estudinates()
    {
        $estudiantes = Estudiante::all();
        return view('sistema.estudiantes.lista_estudiante', compact('estudiantes'));
    }
    public function crear_estudiante(Request $request)
    {
        try {
            $request->validate([
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'ci' => 'required|string|unique:estudiantes,ci',
                'email' => 'nullable|email|max:255',
                'telefono' => 'nullable|string|max:20',
                'codigo_certificado' => 'nullable|string|max:255',
                'fecha_emision' => 'nullable|date',
                'estado' => 'required|in:activo,inactivo'
            ]);

            $estudiante = Estudiante::create($request->all());

            // $estudiante->assignRole('Estudiante');

            return redirect()->back()->with('success', 'Estudiante agregado con exito!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }



    public function actualizar_estudiante(Request $request, $id)
    {
        try {
            $estudiante = Estudiante::findOrFail($id);

            $request->validate([
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'ci' => ['required', 'string', Rule::unique('estudiantes')->ignore($id)],
                'email' => 'nullable|email|max:255',
                'telefono' => 'nullable|string|max:20',
                'codigo_certificado' => 'nullable|string|max:255',
                'fecha_emision' => 'nullable|date',
                'estado' => 'required|in:activo,inactivo'
            ]);

            $estudiante->update($request->all());

            return redirect()->back()->with('success', 'Actualizado con exito!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function eliminar_estudiante($id)
    {
        try {
            $estudiante = Estudiante::findOrFail($id);
            $estudiante->delete();

            return response()->json(['success' => true, 'message' => 'Eliminado con éxito']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}

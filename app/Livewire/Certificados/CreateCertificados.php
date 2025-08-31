<?php

namespace App\Livewire\Certificados;

use App\Models\Certificado;
use App\Models\Posicion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCertificados extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $open = false;
    public $nombre, $descripcion, $estado = 'inactivo', $fecha_inicio, $fecha_fin, $foto;

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
            'estado' => 'required|in:activo,inactivo',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048', // hasta 2MB
        ];
    }

    public function create()
    {
        $this->reset(['nombre', 'descripcion', 'estado', 'fecha_inicio', 'fecha_fin', 'foto']);
        $this->estado = 'activo'; // valor por defecto
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $fotoPath = $this->foto->store('certificados', 'public');

        $certificado = Certificado::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'estado' => $this->estado,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'foto' => $fotoPath,
        ]);

        Posicion::create([
            'certificado_id' => $certificado->id,
            'top' => 300,
            'left' => 200,
            'right' => 200,
            'bottom' => 200,
        ]);

        $this->dispatch('create-certificados');

        $this->reset('nombre', 'descripcion', 'estado', 'fecha_inicio', 'fecha_fin', 'foto', 'open');
    }

    public function updatingOpen()
    {
        if (!$this->open) {
            $this->reset('nombre', 'descripcion', 'estado', 'fecha_inicio', 'fecha_fin', 'foto');
        }
    }

    public function render()
    {
        return view('livewire.certificados.create-certificados');
    }
}

<?php

namespace App\Livewire\Certificados;

use App\Models\Certificado;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Yoeunes\Toastr\Facades\Toastr;

class ShowCertificados extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    // Propiedades de listado
    public $search = "";
    public $sort = 'id';
    public $direction = 'desc';
    public $cantidad = 10;
    public $readyToLoad = false;

    // Propiedades de edición
    public $openEdit = false;
    public $certificado;
    public $certificadoEdit = [];

    // Ordenamiento
    public function order($sort)
    {
        if ($this->sort == $sort) {
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadCertificados()
    {
        $this->readyToLoad = true;
    }

    #[On('create-certificados')]
    public function refresh() {}

    public function rules()
    {
        $rules = [
            'certificadoEdit.nombre' => 'required|string|max:255',
            'certificadoEdit.descripcion' => 'nullable|string',
            'certificadoEdit.estado' => 'required|in:activo,inactivo',
            'certificadoEdit.fecha_inicio' => 'required|date',
            'certificadoEdit.fecha_fin' => 'required|date|after_or_equal:certificadoEdit.fecha_inicio',
            'certificadoEdit.foto' => 'nullable',
        ];

        return $rules;
    }

    public function validationAttributes()
    {
        return [
            'certificadoEdit.nombre' => 'nombre',
            'certificadoEdit.descripcion' => 'descripción',
            'certificadoEdit.estado' => 'estado',
            'certificadoEdit.fecha_inicio' => 'fecha de inicio',
            'certificadoEdit.fecha_fin' => 'fecha de fin',
            'certificadoEdit.foto' => 'plantilla',
        ];
    }

    public function edit(Certificado $certificado)
    {
        $this->certificado = $certificado;

        // Formatear fechas al formato que <input type="datetime-local"> requiere
        $this->certificadoEdit = [
            'nombre' => $certificado->nombre,
            'descripcion' => $certificado->descripcion,
            'estado' => $certificado->estado,
            'fecha_inicio' => $certificado->fecha_inicio
                ? \Carbon\Carbon::parse($certificado->fecha_inicio)->format('Y-m-d\TH:i')
                : null,
            'fecha_fin' => $certificado->fecha_fin
                ? \Carbon\Carbon::parse($certificado->fecha_fin)->format('Y-m-d\TH:i')
                : null,
            'foto' => $certificado->foto,
        ];

        $this->openEdit = true;
    }


    public function cancelEdit()
    {
        $this->reset(['openEdit', 'certificadoEdit', 'certificado']);
    }

    public function update()
    {

        $this->validate();

        // manejo de foto
        if (isset($this->certificadoEdit['foto']) && is_object($this->certificadoEdit['foto'])) {
            if ($this->certificado->foto && Storage::disk('public')->exists($this->certificado->foto)) {
                Storage::disk('public')->delete($this->certificado->foto);
            }
            $photoPath = $this->certificadoEdit['foto']->store('certificados', 'public');
            $this->certificadoEdit['foto'] = $photoPath;
        }

        $this->certificado->update($this->certificadoEdit);
        $this->dispatch('certificadoUpdated');
        $this->cancelEdit();
    }

    public function deleteCertificado($id)
    {
        $certificado = Certificado::find($id);
        if ($certificado) {
            if ($certificado->foto && Storage::disk('public')->exists($certificado->foto)) {
                Storage::disk('public')->delete($certificado->foto);
            }
            $certificado->delete();
            $this->dispatch('certificadoDeleted');
        }
    }
    public function toggleEstado($id)
    {
        $certificado = Certificado::findOrFail($id);

        // Alternar estado
        $certificado->estado = $certificado->estado === 'activo' ? 'inactivo' : 'activo';
        $certificado->save();

        // Refrescar listado
        $this->loadCertificados();

        // Notificación opcional
        $this->dispatch('estadoActualizado');
    }


    public function render()
    {
        if ($this->readyToLoad) {
            $certificados = Certificado::where('id', 'like', '%' . $this->search . '%')
                ->orWhere('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->orWhere('estado', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);
        } else {
            $certificados = [];
        }
        return view('livewire.certificados.show-certificados', compact('certificados'));
    }
}

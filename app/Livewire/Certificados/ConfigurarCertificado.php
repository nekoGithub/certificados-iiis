<?php

namespace App\Livewire\Certificados;

use App\Models\Certificado;
use Livewire\Component;

class ConfigurarCertificado extends Component
{
    public $certificado;
    public $top, $left;
    public $nombreCompleto = 'Brayan Sonco Machaca'; // Nombre de ejemplo para vista previa

    public function mount(Certificado $certificado)
    {
        $this->certificado = $certificado->load('posicion');
        
        if ($this->certificado->posicion) {
            $this->top = $this->certificado->posicion->top ?? 260;
            $this->left = $this->certificado->posicion->left ?? 400;
        } else {
            // Valores por defecto para tamaño carta
            $this->top = 260;
            $this->left = 400;
        }
    }

    public function rules()
    {
        return [
            'top' => 'required|integer|min:0|max:612',   
            'left' => 'required|integer|min:0|max:792',  
        ];
    }

    public function guardarPosicion()
    {
        $this->validate();

        $this->certificado->posicion()->updateOrCreate(
            ['certificado_id' => $this->certificado->id],
            [
                'top' => $this->top,
                'left' => $this->left,
                'right' => null,
                'bottom' => null,
            ]
        );

        session()->flash('message', 'Posición del nombre guardada correctamente.');
        
        // Disparar evento para mostrar modal con PDF
        $this->dispatch('mostrar-preview-modal', [
            'top' => $this->top,
            'left' => $this->left,
        ]);
    }

    public function updatedTop()
    {
        // Removido - no actualizar en tiempo real
    }

    public function updatedLeft()
    {
        // Removido - no actualizar en tiempo real
    }

    public function actualizarPosicion()
    {
        // Removido - solo actualizar al guardar
    }

    public function render()
    {
        return view('livewire.certificados.configurar-certificado')
            ->layout('layouts.admin');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre','apellido','carnet','ru','correo','telefono'
    ];

    public function certificados() {
        return $this->belongsToMany(Certificado::class, 'certificado_estudiante')
                    ->withTimestamps();
    }
}

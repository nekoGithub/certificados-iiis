<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;

    protected $table = 'certificados';
    protected $fillable = [
        'foto','nombre','descripcion','estado',
        'fecha_inicio','fecha_fin','posicion_id'
    ];

    public function posicion() {
        return $this->belongsTo(Posicion::class);
    }

    public function estudiantes() {
        return $this->belongsToMany(Estudiante::class, 'certificado_estudiante')
                    ->withTimestamps();
    }
}

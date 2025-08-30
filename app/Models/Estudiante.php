<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';
    protected $fillable = [
        'nombres',
        'apellidos',
        'ci',
        'email',
        'telefono',
        'codigo_certificado',
        'fecha_emision',
        'estado'
    ];

    protected $casts = [
        'fecha_emision' => 'date'
    ];
}

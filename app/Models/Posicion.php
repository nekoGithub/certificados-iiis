<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    use HasFactory;
    protected $table = 'posiciones';

    protected $fillable = [
        'top',
        'right',
        'bottom',
        'left',
        'certificado_id',
    ];


    public function certificado()
    {
        return $this->belongsTo(Certificado::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flota extends Model
{
    protected $table = 'flota'; // Tabla personalizada
    protected $primaryKey = 'id_flota'; // Clave primaria personalizada
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_chofer',
        'marca',
        'placa',
        'peso_neto',
        'peso_bruto_vehicular',
        'capacidad_carga',
        'alto_contenedor',
        'ancho_contenedor',
        'largo_contenedor',
    ];

    protected $casts = [
        'peso_neto'            => 'double',
        'peso_bruto_vehicular' => 'double',
        'capacidad_carga'      => 'double',
        'alto_contenedor'      => 'double',
        'ancho_contenedor'     => 'double',
        'largo_contenedor'     => 'double',
    ];

    public function chofer()
    {
        return $this->belongsTo(Chofer::class, 'id_chofer');
    }
}

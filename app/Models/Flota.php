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
        'id_flota', // 👈 Agrega esto para que se pueda usar en create()
        'id_chofer',
        'placa',
        'capacidad_volumen_m3',
    ];

    public function chofer()
    {
        return $this->belongsTo(Chofer::class, 'id_chofer');
    }
}

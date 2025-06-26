<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logistica extends Model
{
    protected $table = 'logisticas';
    protected $primaryKey = 'id_usuario'; // modificado: clave primaria ahora es id_usuario
    public $incrementing = false;      // modificado: no auto-increment
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',   // modificado: FK a usuarios
        'almacen_base',
        'area_asignada'
    ];

    /**
     * Relación inversa: cada Logística pertenece a un Usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario',   // modificado: FK en logisticas
            'id_usuario'    // PK en usuarios
        );
    }
}

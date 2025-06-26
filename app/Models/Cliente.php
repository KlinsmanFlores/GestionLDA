<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Tabla y PK
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = true;

    // Campos asignables
    protected $fillable = [
        'id_usuario',    // modificado: para clave foránea a usuarios
        'ruc',
        'razon_social',
        'numero',
        'correo',
        'direccion'
    ];

    /**
     * Relación inversa: cada Cliente pertenece a un Usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario',   // modificado: FK en clientes
            'id_usuario'    // PK en usuarios
        );
    }
}

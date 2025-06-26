<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    protected $table = 'choferes';
    protected $primaryKey = 'id_chofer';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',   // modificado: permite asignar la FK a usuarios
        'licencia',
    ];

    /**
     * Cada chofer pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario',   // modificado: clave foránea en esta tabla
            'id_usuario'    // clave primaria en usuarios
        );
    }

    /**
     * Relación con la flota asignada al chofer.
     */
    public function flota()
    {
        return $this->hasOne(
            Flota::class,
            'id_chofer',    // FK en flota
            'id_chofer'
        );
    }
}

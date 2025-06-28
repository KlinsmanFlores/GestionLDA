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
        'id_usuario',
        'tipo_cliente',
        'direccion',
        'referencia',
        // aquí puedes agregar más campos propios de cliente
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


    public function facturaciones() {
        return $this->hasMany(Facturacion::class, 'id_cliente');
    }
}

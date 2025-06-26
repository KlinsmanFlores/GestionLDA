<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    protected $primaryKey = 'id_vendedor';
    public $incrementing = true;   // PK es auto-incremental
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',            // FK a usuarios
        'zona',
        'comision',
    ];

    /**
     * Cada vendedor pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario',   // FK en vendedores
            'id_usuario'    // PK en usuarios
        );
    }
}

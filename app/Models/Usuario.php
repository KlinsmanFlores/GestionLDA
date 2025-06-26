<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rol;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'apellidos',
        'dni',
        'correo',
        'telefono',
        'contrasena',
        'id_rol',
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    // Relaciones especializadas
    public function cliente()
    {
        return $this->hasOne(
            Cliente::class,
            'id_usuario', // modificado: clave foránea en clientes
            'id_usuario'
        );
    }

    public function chofer()
    {
        return $this->hasOne(
            Chofer::class,
            'id_usuario', // modificado: clave foránea en choferes
            'id_usuario'
        );
    }

    public function vendedor()
    {
        return $this->hasOne(
            Vendedor::class,
            'id_vendedor', // mantiene id_vendedor como FK
            'id_usuario'
        );
    }

    public function logistica()
    {
        return $this->hasOne(
            Logistica::class,
            'id_usuario', // modificado: clave foránea en logisticas
            'id_usuario'
        );
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rol;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios'; // <- Usa tu tabla personalizada

    protected $primaryKey = 'id_usuario'; // <- Tu clave primaria personalizada

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

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}

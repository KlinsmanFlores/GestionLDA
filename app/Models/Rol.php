<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id'; // tu PK es 'id' gracias al $table->id()

    protected $fillable = [
        'nombre',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_rol');
    }
}

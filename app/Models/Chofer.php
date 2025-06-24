<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    protected $table = 'choferes';
    protected $primaryKey = 'id_chofer';
    public $timestamps = false;

    protected $fillable = [
        'id_chofer',
        'licencia',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_chofer');
    }

    public function flota()
    {
        return $this->hasOne(Flota::class, 'id_chofer');
    }
}


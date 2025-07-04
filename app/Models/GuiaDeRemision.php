<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuiaDeRemision extends Model
{
    protected $table = 'guia_de_remision';

    protected $fillable = [
        'pedido_id',
        'camion_id', // este es el nombre correcto según tu migración
        'punto_partida',
        'punto_llegada',
        'fecha_envio' => 'datetime',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function camion() // puedes llamarlo camion o flota, solo asegúrate que coincida
    {
        return $this->belongsTo(Flota::class, 'camion_id', 'id_flota');
    }

    public function flota()
    {
        return $this->belongsTo(Flota::class, 'camion_id', 'id_flota');
    }

}
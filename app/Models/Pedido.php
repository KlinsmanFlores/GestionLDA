<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'id_cliente',
        'fecha',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'id_cliente');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }

    public function volumenTotal()
    {
        return $this->detalles->sum(function ($detalle) {
            $producto = $detalle->producto;
            $volumenUnitario = $producto->alto * $producto->ancho * $producto->largo; // en cm³
            return $volumenUnitario * $detalle->cantidad;
        });
    }


    public function calcularVolumenTotal()
    {
        return $this->detalles->sum(function ($detalle) {
            return $detalle->calcularVolumenTotal();
        });
    }

}

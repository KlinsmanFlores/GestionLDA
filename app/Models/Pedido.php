<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'id_cliente',
        'fecha',
        'estado',         // 
        'estado_factura', //
        'estado_envio',   //
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente','id_cliente');//cambiado de usuario a client
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

    public function facturacion()
    {
        return $this->hasOne(Facturacion::class, 'id_facturacion', 'facturacion_id');
        // O el campo FK que uses para enlazar Pedido → Facturacion
    }

}

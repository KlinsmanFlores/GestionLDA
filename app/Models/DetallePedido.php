<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class DetallePedido extends Model
{
    protected $table = 'detalle_pedidos';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'volumen_unitario',
        'volumen_total',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }


    public function calcularVolumenTotal()
    {
        return $this->cantidad * (
            $this->producto->alto *
            $this->producto->ancho *
            $this->producto->largo
        );
    }
}

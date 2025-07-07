<?php
// app/Observers/DetallePedidoObserver.php

namespace App\Observers;

use App\Models\DetallePedido;

class DetallePedidoObserver
{
    public function created(DetallePedido $detalle)
    {
        // Al crear un detalle, decrementa stock
        $detalle->producto->decrement('stock_mano', $detalle->cantidad);
    }

    public function updated(DetallePedido $detalle)
    {
        // Si cambió la cantidad, ajusta el stock según delta
        $original = $detalle->getOriginal('cantidad');
        $delta = $detalle->cantidad - $original;
        // Si delta > 0 restamos más, si delta < 0 devolvemos stock
        $detalle->producto->decrement('stock_mano', $delta);
    }

    public function deleted(DetallePedido $detalle)
    {
        // Al borrar un detalle, restaura stock
        $detalle->producto->increment('stock_mano', $detalle->cantidad);
    }
}

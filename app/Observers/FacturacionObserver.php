<?php
// app/Observers/FacturacionObserver.php

namespace App\Observers;

use App\Models\Facturacion;

class FacturacionObserver
{
    public function created(Facturacion $factura)
    {
        // Al facturar, marca el pedido como facturado
        $factura->pedido()->update(['estado_factura' => 'facturado']);
    }
}

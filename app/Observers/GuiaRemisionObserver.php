<?php
// app/Observers/GuiaRemisionObserver.php

namespace App\Observers;

use App\Models\GuiaDeRemision;

class GuiaRemisionObserver
{
    public function created(GuiaDeRemision $guia)
    {
        // Al crear la guía, marca el pedido como enviado y fija fecha_envio
        $guia->pedido()->update([
            'estado_envio' => 'enviado',
            'fecha_envio'  => $guia->fecha_emision,
        ]);
    }
}

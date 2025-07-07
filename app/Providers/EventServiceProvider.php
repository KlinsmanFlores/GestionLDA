<?php
// app/Providers/EventServiceProvider.php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\DetallePedido;
use App\Models\Facturacion;
use App\Models\GuiaDeRemision;
use App\Observers\DetallePedidoObserver;
use App\Observers\FacturacionObserver;
use App\Observers\GuiaRemisionObserver;

class EventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        DetallePedido::observe(DetallePedidoObserver::class);
        Facturacion::observe(FacturacionObserver::class);
        GuiaDeRemision::observe(GuiaRemisionObserver::class);
    }
}

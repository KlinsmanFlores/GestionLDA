<?php

namespace App\Services;

use App\Models\Pedido;
use App\Models\Flota;
use App\Models\GuiaDeRemision;
use App\Models\Chofer;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Services\OrderCalculationService;

class LogisticaService
{
    protected OrderCalculationService $orderCalc;

    public function __construct(OrderCalculationService $orderCalc)
    {
        $this->orderCalc = $orderCalc;
    }

    public function fetchPendingOrders(): Collection
    {
        return Pedido::with([
            'detalles.producto',
            'cliente.usuario',    // <–– cargamos Cliente → Usuario
        ])
        ->where('estado_factura', 'facturado')
        ->where('estado_envio', 'pendiente')
        ->get();
    }

    public function groupByZone(Collection $pedidos): array
    {
        return $pedidos
            ->groupBy(fn(Pedido $pedido) => $pedido->cliente->distrito ?? 'Sin Zona')
            ->toArray();
    }

    public function packOrdersIntoTruck(Collection $pedidos, Flota $camion): Collection
    {
        $volumenCamionM3 = (
            $camion->alto_contenedor *
            $camion->ancho_contenedor *
            $camion->largo_contenedor
        ) / 1_000_000;

        $sorted  = $pedidos->sortByDesc(fn(Pedido $p) => $this->getPedidoVolumen($p));
        $assigned = collect();
        $remaining = $volumenCamionM3;

        foreach ($sorted as $pedido) {
            $vol = $this->getPedidoVolumen($pedido);
            if ($vol <= $remaining) {
                $assigned->push($pedido);
                $remaining -= $vol;
            }
        }

        return $assigned;
    }

    public function findAvailableTrucks(string $zona): Collection
    {
        return Flota::whereNull('id_chofer')->get();
    }

    /**
     * Asigna al $pedido el primer camión y chofer disponibles.
     * 
     * @return array ['pedido'=>Pedido, 'camion'=>Flota, 'chofer'=>Chofer] o [] si falla
     */
    public function assignByCapacity(Pedido $pedido): ?array
    {
        // Todos los camiones, sin filtrar por estado
        $camiones = Flota::orderBy('id_flota')->get();

        // El primer chofer disponible (o ajusta tu propia regla)
        $chofer = Chofer::orderBy('id_usuario')->first();

        foreach ($camiones as $camion) {
            // Intentamos empaquetar SOLO este pedido
            $toAssign = $this->packOrdersIntoTruck(
                collect([$pedido]),
                $camion
            );

            if ($toAssign->isNotEmpty()) {
                // ¡En este camión cabe!
                return [
                    'pedido' => $pedido,
                    'camion' => $camion,
                    'chofer' => $chofer,
                ];
            }
        }

        // No hay ningún camión con suficiente capacidad
        return null;
    }

    public function createGuides(array $assignments): Collection
    {
        $guides = collect();

        foreach ($assignments as $asig) {
            $camion  = $asig['camion'];
            $pedidos = $asig['pedidos'];

            foreach ($pedidos as $pedido) {
                $puntoLlegada = optional($pedido->facturacion)->direccion
                            ?? $pedido->cliente->direccion
                            ?? 'Destino no especificado';

                $guia = GuiaDeRemision::create([
                    'pedido_id'     => $pedido->id,
                    'camion_id'     => $camion->id_flota,      // ← aquí
                    'fecha_envio'   => Carbon::now(),
                    'punto_partida' => 'Almacén Central',
                    'punto_llegada' => $puntoLlegada,
                ]);

                $pedido->update(['estado_envio' => 'en_ruta']);

                $guides->push($guia);
            }
        }

        return $guides;
    }

    private function getPedidoVolumen(Pedido $pedido): float
    {
        $items = $pedido->detalles->map(fn($d) => [
            'volumen_unitario' => $this->calculateUnitVolume($d->producto),
            'cantidad'         => $d->cantidad,
        ])->toArray();

        return $this->orderCalc->calculateVolumen($items);
    }

    private function calculateUnitVolume($producto): float
    {
        $volumenCm3 = $producto->alto * $producto->ancho * $producto->largo;
        return round($volumenCm3 / 1_000_000, 4);
    }
}

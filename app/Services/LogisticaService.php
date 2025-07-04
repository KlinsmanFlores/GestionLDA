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
        return Pedido::with(['detalles.producto', 'cliente'])
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

    public function planAssignments(array $gruposPorZona): array
    {
        $assignments = [];

        foreach ($gruposPorZona as $zona => $pedidosZona) {
            $trucks  = $this->findAvailableTrucks($zona);
            $choferes = Chofer::all();

            foreach ($trucks as $camion) {
                $choferSeleccionado = $choferes->shift();
                if (! $choferSeleccionado) {
                    continue 2;
                }

                $camion->update(['id_chofer' => $choferSeleccionado->id_usuario]);

                $toAssign = $this->packOrdersIntoTruck($pedidosZona, $camion);
                if ($toAssign->isEmpty()) {
                    continue;
                }

                $assignments[] = [
                    'zona'    => $zona,
                    'camion'  => $camion,
                    'pedidos' => $toAssign,
                    'chofer'  => $choferSeleccionado,
                ];

                $pedidosZona = $pedidosZona->diff($toAssign);
                if ($pedidosZona->isEmpty()) {
                    break;
                }
            }
        }

        return $assignments;
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
                    'camion_id'     => $camion?->id_flota,
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

<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OrderCalculationService;

class PedidoController extends Controller
{
    protected OrderCalculationService $orderCalc;

    public function __construct(OrderCalculationService $orderCalc)
    {
        $this->orderCalc = $orderCalc;
        //$this->middleware('auth');
    }

    public function crear()
    {
        $productos = Producto::all();
        return view('cliente.pedido.crear', compact('productos'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'productos.*.id'       => 'required|exists:producto,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Crear cabecera
        $pedido = Pedido::create([
            'id_cliente'     => Auth::id(),
            'fecha'          => now(),
            'estado'         => 'pendiente',
            'estado_envio'   => 'pendiente',
            'estado_factura' => 'pendiente',
        ]);

        $items = [];
        foreach ($request->productos as $p) {
            $prod    = Producto::find($p['id']);
            $volUnit = ($prod->alto ?: 1) * ($prod->ancho ?: 1) * ($prod->largo ?: 1);

            DetallePedido::create([
                'pedido_id'        => $pedido->id,
                'producto_id'      => $prod->id_producto,
                'cantidad'         => $p['cantidad'],
                'volumen_unitario' => $volUnit,
                'volumen_total'    => $volUnit * $p['cantidad'],
            ]);

            $items[] = [
                'pvp'               => $prod->pvp,
                'cantidad'          => $p['cantidad'],
                'volumen_unitario'  => $volUnit,
                'peso'              => $prod->peso,
            ];
        }

        // Cálculos con el servicio
        $subtotal = $this->orderCalc->calculateSubtotal($items);
        $igv      = $this->orderCalc->calculateIGV($subtotal);
        $total    = $this->orderCalc->calculateTotal($subtotal, $igv);
        $volumen  = $this->orderCalc->calculateVolumen($items);
        $peso     = $this->orderCalc->calculatePeso($items);

        // Guarda totales en la cabecera si lo deseas
        $pedido->update(compact('subtotal','igv','total'));

        // Recarga relaciones para la vista
        $pedido->load('detalles.producto');

        return view('cliente.resumen', compact(
            'pedido',
            'subtotal',
            'igv',
            'total',
            'volumen',
            'peso'
        ));
    }

    public function editarDetalle(DetallePedido $detalle)
    {
        if ($detalle->pedido->id_cliente !== Auth::id()) {
            abort(403);
        }

        $detalle->load('producto');
        return view('cliente.pedido.editar-detalle', compact('detalle'));
    }

    public function actualizarDetalle(Request $request, DetallePedido $detalle)
    {
        if ($detalle->pedido->id_cliente !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        // Actualiza la línea
        $detalle->cantidad      = $request->cantidad;
        $detalle->volumen_total = $detalle->volumen_unitario * $detalle->cantidad;
        $detalle->save();

        // Recalcula todos los totales
        $pedido = $detalle->pedido;
        $pedido->load('detalles.producto');

        $items = $pedido->detalles->map(fn($d) => [
            'pvp'              => $d->producto->pvp,
            'cantidad'         => $d->cantidad,
            'volumen_unitario' => $d->volumen_unitario,
            'peso'             => $d->producto->peso,
        ])->toArray();

        $subtotal = $this->orderCalc->calculateSubtotal($items);
        $igv      = $this->orderCalc->calculateIGV($subtotal);
        $total    = $this->orderCalc->calculateTotal($subtotal, $igv);
        $volumen  = $this->orderCalc->calculateVolumen($items);
        $peso     = $this->orderCalc->calculatePeso($items);

        // Retorna la vista de resumen con datos actualizados
        return view('cliente.resumen', compact(
            'pedido',
            'subtotal',
            'igv',
            'total',
            'volumen',
            'peso'
        ));
    }

    public function eliminarDetalle(DetallePedido $detalle)
    {
        if ($detalle->pedido->id_cliente !== Auth::id()) {
            abort(403);
        }

        // Guarda referencia al pedido
        $pedido = $detalle->pedido;

        // Elimina la línea
        $detalle->delete();

        // Recalcula totales sobre las líneas restantes
        $pedido->load('detalles.producto');

        $items = $pedido->detalles->map(fn($d) => [
            'pvp'              => $d->producto->pvp,
            'cantidad'         => $d->cantidad,
            'volumen_unitario' => $d->volumen_unitario,
            'peso'             => $d->producto->peso,
        ])->toArray();

        $subtotal = $this->orderCalc->calculateSubtotal($items);
        $igv      = $this->orderCalc->calculateIGV($subtotal);
        $total    = $this->orderCalc->calculateTotal($subtotal, $igv);
        $volumen  = $this->orderCalc->calculateVolumen($items);
        $peso     = $this->orderCalc->calculatePeso($items);

        return view('cliente.resumen', compact(
            'pedido',
            'subtotal',
            'igv',
            'total',
            'volumen',
            'peso'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Facturacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OrderCalculationService;

class FacturacionController extends Controller
{
    protected OrderCalculationService $orderCalc;

    public function __construct(OrderCalculationService $orderCalc)
    {
        $this->orderCalc = $orderCalc;
       // $this->middleware('auth');
    }

    /**
     * 1) Mostrar formulario para ingresar datos de factura.
     */
    public function formularioFacturar(int $pedidoId)
    {
        $pedido = Pedido::with('detalles.producto')->findOrFail($pedidoId);

        // Serie fija y próximo correlativo
        $serie           = 'F001';
        $nextCorrelativo = (Facturacion::max('correlativo') ?? 0) + 1;

        // Cálculos previos para el form
        $items = $pedido->detalles->map(fn($d) => [
            'pvp'              => $d->producto->pvp,
            'cantidad'         => $d->cantidad,
            'volumen_unitario' => $d->volumen_unitario,
            'peso'             => $d->producto->peso,
        ])->toArray();

        $subtotal = $this->orderCalc->calculateSubtotal($items);
        $igv      = $this->orderCalc->calculateIGV($subtotal);
        $total    = $this->orderCalc->calculateTotal($subtotal, $igv);

        return view('cliente.facturacion', compact(
            'pedido',
            'serie',
            'nextCorrelativo',
            'subtotal',
            'igv',
            'total'
        ));
    }

    /**
     * 2) Procesar el formulario: crear Cliente (o actualizar) y Facturación.
     *    Luego mostrar la vista de estado del pedido.
     */
    public function pagar(Request $request, int $pedidoId)
    {
        $data = $request->validate([
            'ruc'              => 'required|string|max:20',
            'razon_social'     => 'required|string|max:150',
            'direccion_fiscal' => 'required|string|max:255',
            'medio_pago'       => 'required|string|max:50',
            'tipo_cliente'     => 'required|in:natural,juridica',
            'referencia'       => 'nullable|string|max:255',
            'serie'            => 'required|string|max:10',
            'nextCorrelativo'  => 'required|integer',
        ]);

        $pedido = Pedido::with('detalles.producto')->findOrFail($pedidoId);

        // Crear o actualizar datos de Cliente
        $cliente = Cliente::updateOrCreate(
            ['id_usuario' => Auth::id()],
            [
                'direccion'    => $data['direccion_fiscal'],
                'tipo_cliente' => $data['tipo_cliente'],
                'referencia'   => $data['referencia'] ?? '',
            ]
        );

        // Rehacer cálculos con el servicio
        $items = $pedido->detalles->map(fn($d) => [
            'pvp'              => $d->producto->pvp,
            'cantidad'         => $d->cantidad,
            'volumen_unitario' => $d->volumen_unitario,
            'peso'             => $d->producto->peso,
        ])->toArray();

        $subtotal = $this->orderCalc->calculateSubtotal($items);
        $igv      = $this->orderCalc->calculateIGV($subtotal);
        $total    = $this->orderCalc->calculateTotal($subtotal, $igv);

        // Guardar Facturación
        $factura = Facturacion::create([
            'id_cliente'   => $cliente->id_cliente,
            'serie'        => $data['serie'],
            'correlativo'  => $data['nextCorrelativo'],
            'ruc'          => $data['ruc'],
            'razon_social' => $data['razon_social'],
            'direccion'    => $data['direccion_fiscal'],
            'medio_pago'   => $data['medio_pago'],
            'fecha'        => now()->toDateString(),
            'subtotal'     => $subtotal,
            'igv'          => $igv,
            'total'        => $total,
        ]);

        // Marcar pedido como facturado
        $pedido->update(['estado_factura' => 'facturado']);

        // Mostrar estado del pedido
        return view('cliente.estado', compact('pedido'));
    }

    /**
     * 3) Mostrar la factura ya guardada (solo lectura).
     */
    public function mostrarFactura(int $facturaId)
    {
        $factura = Facturacion::with('cliente')->findOrFail($facturaId);

        $pedido = Pedido::with('detalles.producto')
            ->where('id_cliente', $factura->id_cliente)
            ->where('estado_factura', 'facturado')
            ->latest('updated_at')
            ->firstOrFail();

        return view('cliente.factura-ver', compact('factura', 'pedido'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function crear()
    {
        $productos = Producto::all();
        return view('cliente.pedido.crear', compact('productos'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'productos.*.id' => 'required|exists:producto,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $pedido = Pedido::create([
            'id_cliente' => Auth::id(),
            'estado' => 'pendiente',
        ]);

        foreach ($request->productos as $productoData) {
            $producto = Producto::find($productoData['id']);

            $volumen_unitario = ($producto->alto ?? 1) * ($producto->ancho ?? 1) * ($producto->largo ?? 1);
            $cantidad = $productoData['cantidad'];
            $volumen_total = $volumen_unitario * $cantidad;

            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto->id_producto,
                'cantidad' => $cantidad,
                'volumen_unitario' => $volumen_unitario,
                'volumen_total' => $volumen_total,
            ]);
        }

        return view('cliente.resumen', [
            'pedido' => $pedido->load('detalles.producto'),
        ]);
    }

    public function facturar(Request $request, $id)
    {
        $request->validate([
            'ruc' => 'required|string|max:20',
            'razon_social' => 'required|string|max:150',
            'direccion_fiscal' => 'required|string|max:255',
            'medio_pago' => 'required|string|max:50',
        ]);

        $pedido = Pedido::with('detalles.producto')->findOrFail($id);

        $subtotal = $pedido->detalles->sum(fn($d) => $d->cantidad * $d->producto->pvp);
        $igv = $subtotal * 0.18;
        $total = $subtotal + $igv;

        $pedido->update([
            'ruc' => $request->ruc,
            'razon_social' => $request->razon_social,
            'direccion_fiscal' => $request->direccion_fiscal,
            'medio_pago' => $request->medio_pago,
            'subtotal' => $subtotal,
            'igv' => $igv,
            'total' => $total,
        ]);

        return view('cliente.estado', ['pedido' => $pedido]);

    }

    public function formularioFacturar($id)
    {
        $pedido = Pedido::with('detalles.producto')->findOrFail($id);
        return view('cliente.facturacion', compact('pedido'));
    }  


}

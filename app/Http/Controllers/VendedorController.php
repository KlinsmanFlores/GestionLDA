<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class VendedorController extends Controller
{
    public function pedidosPendientes()
    {
        $pedidos = Pedido::with('detalles.producto')
            ->where('estado_factura', 'pendiente')
            ->get();

        return view('vendedor.pedidos', compact('pedidos'));
    }

    public function confirmarFactura($id)
    {
        $pedido = Pedido::with('detalles.producto')->findOrFail($id);

        foreach ($pedido->detalles as $detalle) {
            $producto = $detalle->producto;

            if ($producto->stock_mano < $detalle->cantidad) {
                return redirect()->back()->withErrors([
                    'stock' => "No hay suficiente stock para el producto: {$producto->nombre}"
                ]);
            }
        }

        // Si todo está bien, actualizamos stock y confirmamos la factura
        foreach ($pedido->detalles as $detalle) {
            $producto = $detalle->producto;
            $producto->stock_mano -= $detalle->cantidad;
            $producto->save();
        }

        $pedido->estado_factura = 'facturado';
        $pedido->save();

        return redirect()->route('vendedor.pedidos')->with('success', 'Factura confirmada y stock actualizado.');
    }

}

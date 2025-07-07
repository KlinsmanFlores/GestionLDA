<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

use App\Models\Vendedor;
use App\Models\Usuario;

class VendedorController extends Controller
{

    /**
     * Mostrar formulario para completar datos de vendedor.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\View\View
     */
    public function create(Usuario $usuario)
    {
        // Solo usuarios con rol 4 (Vendedor)
        if ($usuario->id_rol !== 4) {
            abort(403, 'Acceso denegado: usuario no es vendedor.');
        }

        return view('admin.vendedores.crear', compact('usuario'));
    }

    /**
     * Almacenar datos de vendedor en la tabla 'vendedores'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'zona'        => 'required|string|max:100',
            'comision'    => 'required|numeric|between:0,99.99',
        ]);

        // Verifica rol por seguridad
        $usuario = Usuario::findOrFail($data['id_usuario']);
        if ($usuario->id_rol !== 4) {
            abort(403, 'Acceso denegado: usuario no es vendedor.');
        }

        // Crea registro en 'vendedores'
        Vendedor::create([
            'id_usuario' => $data['id_usuario'],
            'zona'        => $data['zona'],
            'comision'    => $data['comision'],
        ]);

        return redirect()->route('admin.usuarios.roles')
                    ->with('success', 'Vendedor registrado correctamente.');
    }


    public function pedidosPendientes()
    {
        $pedidos = Pedido::with('cliente','detalles.producto')   //añadido cliente por los pedidos de vendedor
            ->where('estado', 'pendiente')
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

        $pedido->estado = 'recibido';
        $pedido->save();

        return redirect()->route('vendedor.pedidos')->with('success', 'Factura confirmada y stock actualizado.');
    }


        /**
     * Eliminar un pedido si su estado es 'pendiente' o 'facturado'.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function eliminarPedido($id)
    {
        // Busca el pedido o lanza 404
        $pedido = Pedido::findOrFail($id);

        // Verifica que el estado permita eliminación
        if (!in_array($pedido->estado, ['pendiente', 'facturado'])) {
            return redirect()->back()->with('error', "No se puede eliminar un pedido con estado “{$pedido->estado}”.");
        }

        // Guarda el estado antes de borrar, por si quieres usarlo en el mensaje
        $estado = $pedido->estado;

        // Elimina el pedido
        $pedido->delete();

        // Redirige a la lista con mensaje
        return redirect()
            ->route('vendedor.pedidos')
            ->with('success', "Pedido con estado “{$estado}” eliminado correctamente.");
    }


}

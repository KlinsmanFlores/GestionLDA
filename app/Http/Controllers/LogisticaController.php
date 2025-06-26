<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Flota;
use App\Models\GuiaDeRemision;



use App\Models\Usuario;
use App\Models\Logistica;

class LogisticaController extends Controller
{

    public function create(Usuario $usuario)
    {
        if ($usuario->id_rol !== 5) {
            abort(403, 'Acceso denegado: usuario no es logística.');
        }
        return view('admin.logisticas.crear', compact('usuario'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario'    => 'required|exists:usuarios,id_usuario',
            'almacen_base'  => 'required|string|max:150',
            'area_asignada' => 'required|string|max:100',
        ]);

        $usuario = Usuario::findOrFail($data['id_usuario']);
        if ($usuario->id_rol !== 5) {
            abort(403, 'Acceso denegado: usuario no es logística.');
        }

        Logistica::create([
            'id_usuario'    => $data['id_usuario'],
            'almacen_base'  => $data['almacen_base'],
            'area_asignada' => $data['area_asignada'],
        ]);

        return redirect()->route('admin.usuarios.roles')
                        ->with('success', 'Logística registrada correctamente.');
    }





    public function pedidosPendientes()
    {
        $pedidos = Pedido::with('cliente', 'detalles.producto')
            ->where('estado_factura', 'facturado') // Ya confirmados por el vendedor
            ->where('estado_envio', 'pendiente') // Aún no enviados
            ->get();

        return view('logistica.pedidos_pendientes', compact('pedidos'));
    }

    
    public function marcarComoEnviado($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado_envio = 'enviado';
        $pedido->save();

        return redirect()->route('logistica.pedidos')->with('success', 'Pedido marcado como enviado.');
    }
    

    public function asignarCamion($pedidoId)
    {
        $pedido = Pedido::with('detalles.producto', 'cliente')->findOrFail($pedidoId);
        $volumenPedido = $pedido->volumenTotal();

        $camionDisponible = Flota::all()->first(function ($camion) use ($volumenPedido) {
            $volumenCamion = $camion->alto_contenedor * $camion->ancho_contenedor * $camion->largo_contenedor;
            return $volumenPedido <= $volumenCamion;
        });

        if (!$camionDisponible) {
            return back()->with('error', 'No hay camiones con suficiente capacidad.');
        }

        // Cambiar estado automáticamente a enviado
        $pedido->update(['estado' => 'enviado']);



        //dd($camionDisponible);

        /***/
        // Crear guía de remisión
        $guia = GuiaDeRemision::create([
            'pedido_id' => $pedido->id,
            'camion_id' => $camionDisponible->id_flota, // importante que coincida
            'fecha_envio' => now(),
            'punto_partida' => 'Almacén Central',
            'punto_llegada' => $pedido->cliente->direccion ?? 'Dirección del cliente',
        ]);
        $guia->load('flota');

        return view('logistica.guia', compact('guia'));


    }



}

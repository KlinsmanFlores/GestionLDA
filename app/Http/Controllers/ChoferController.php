<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuiaDeRemision;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth; 

use App\Models\Usuario;
use App\Models\Chofer;

class ChoferController extends Controller
{

    /**
     * Mostrar formulario para completar datos de chofer.
     *
     * @param  \App\Models\Usuario  $usuario
     */
    public function create(Usuario $usuario)
    {
        // Asegura que solo usuarios con rol 3 (Chofer) puedan acceder
        if ($usuario->id_rol !== 3) {
            abort(403, 'Acceso denegado: usuario no es transportista.');
        }

        return view('admin.choferes.crear', compact('usuario'));
    }

    /**
     * Almacenar datos de chofer en la tabla 'choferes'.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'licencia'   => 'required|string|max:50',
        ]);

        // Verifica rol por seguridad
        $usuario = Usuario::findOrFail($data['id_usuario']);
        if ($usuario->id_rol !== 3) {
            abort(403, 'Acceso denegado: usuario no es transportista.');
        }

        Chofer::create($data);

        return redirect()->route('admin.usuarios.roles')
                        ->with('success', 'Chofer registrado correctamente.');
    }








    
    // Mostrar guías asignadas al chofer autenticado
    public function guiasAsignadas()
    {
        $choferId = Auth::user()->id; // Usamos el ID del usuario logueado

        $guias = GuiaDeRemision::with('pedido', 'flota')
            ->whereHas('flota', function ($q) use ($choferId) {
                $q->where('id_chofer', $choferId);
            })->get();

        return view('chofer.guias', compact('guias'));
    }

    // Ver detalles de una guía
    public function verGuia($id)
    {
        $guia = GuiaDeRemision::with('pedido', 'flota')->findOrFail($id);
        return view('chofer.ver-guia', compact('guia'));
    }

    // Marcar pedido como entregado
    public function marcarEntregado($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = 'entregado';
        $pedido->save();

        return redirect()->route('chofer.guias')->with('success', 'Pedido marcado como entregado');
    }

    // Marcar pedido como cancelado
    public function marcarCancelado($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = 'cancelado';
        $pedido->save();

        return redirect()->route('chofer.guias')->with('error', 'Pedido cancelado. Logística debe reponer stock.');
    }
}

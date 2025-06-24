<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuiaDeRemision;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth; 

class ChoferController extends Controller
{
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

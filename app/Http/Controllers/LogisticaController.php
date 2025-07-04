<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\GuiaDeRemision;
use App\Services\LogisticaService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
  

class LogisticaController extends Controller
{
    protected LogisticaService $logisticaService;

    public function __construct(LogisticaService $logisticaService)
    {
        //$this->middleware('auth');
        $this->logisticaService = $logisticaService;
    }

    public function pedidosPendientes()
    {
        $pedidos = $this->logisticaService->fetchPendingOrders();
        return view('logistica.pedidos', compact('pedidos'));
    }

    public function marcarComoEnviado($id)
    {
        $assign = [
            [
                'camion'  => null,
                'pedidos' => collect([Pedido::findOrFail($id)]),
            ]
        ];

        $guias = $this->logisticaService->createGuides($assign);

        return redirect()
            ->route('logistica.pedidos')
            ->with('success', "Guía #{$guias->first()->id} generada para el pedido {$id}");
    }

    public function asignarCamion($pedidoId)
{
    // 1) Obtiene el pedido puntual
    $pedido = $this->logisticaService
                    ->fetchPendingOrders()
                    ->firstWhere('id', $pedidoId);

    // 2) Planifica asignaciones → devuelve array de assignments
    $assignments = $this->logisticaService->planAssignments([
        'Zona Única' => collect([$pedido])
    ]);

    // Si no hay assignments, manda un error
    if (empty($assignments)) {
        return redirect()
            ->route('logistica.pedidos')
            ->with('error', 'No hay camiones o choferes disponibles para procesar este pedido.');
    }

    // 3) Crea guías
    $guias = $this->logisticaService->createGuides($assignments);

    // Si aun así no se creó ninguna guía, también fallo seguro
    if ($guias->isEmpty()) {
        return redirect()
            ->route('logistica.pedidos')
            ->with('error', 'Ocurrió un problema creando la guía del pedido.');
    }

    // 4) Redirige con éxito
    return redirect()
        ->route('logistica.pedidos')
        ->with('success',
            "Pedido #{$pedidoId} asignado. Guía #{$guias->first()->id} generada."
        );
}


    public function historial()
    {
        $guias = GuiaDeRemision::with(['pedido.cliente', 'flota'])
            ->orderBy('fecha_envio', 'desc')
            ->paginate(15);

        return view('logistica.historial', compact('guias'));
    }

    public function mostrarGuia($id)
    {
        $guia = GuiaDeRemision::with(['pedido.cliente', 'flota'])
                ->findOrFail($id);

        return view('logistica.guia_resumen', compact('guia'));
    }

    public function descargarGuia($id)
{
    // 1. Cargar guía con relaciones
    $guia = GuiaDeRemision::with(['pedido.cliente', 'flota.chofer.usuario'])
            ->findOrFail($id);

    // 2. Generar PDF desde la vista 'logistica.guia_pdf'
    $pdf = PDF::loadView('logistica.guia_pdf', compact('guia'))
                ->setPaper('a4', 'portrait');

    // 3. Devolver descarga
    return $pdf->download("guia_{$guia->id}.pdf");
}
}

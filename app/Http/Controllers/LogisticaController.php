<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\GuiaDeRemision;
use App\Services\LogisticaService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Logistica;
use App\Models\Usuario;


class LogisticaController extends Controller
{
    protected LogisticaService $logisticaService;

    public function __construct(LogisticaService $logisticaService)
    {
        //$this->middleware('auth');
        $this->logisticaService = $logisticaService;
    }

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
        $pedido = Pedido::findOrFail($pedidoId);

        $assignment = $this->logisticaService->assignByCapacity($pedido);

        if (! $assignment) {
            return redirect()->route('logistica.pedidos')->with('error', 'Ningún camión tiene capacidad para este pedido.');
        }

        // Guarda vínculo pedido → camión & chofer (ajusta nombres de fk según tu tabla)
        $pedido->update([
            'flota_id'   => $assignment['camion']->id,
            'chofer_id'  => $assignment['chofer']->id_chofer,
            'estado_envio' => 'asignado',   // si quieres seguir marcando el envío
        ]);

        $pedido = Pedido::find($pedidoId);
        

        // (Opcional) guardar la relación bidireccional en Flota:
        $assignment['camion']->update([
            'id_chofer' => $assignment['chofer']->id_chofer,
        ]);

        // Crea la(s) guía(s) para este pedido
        $assignments = [[
            'camion'  => $assignment['camion'],
            'pedidos' => collect([$pedido]),
        ]];

        $guias = $this->logisticaService->createGuides($assignments);

        if ($guias->isEmpty()) {
            return redirect()
                ->route('logistica.pedidos')
                ->with('error', 'Ocurrió un problema creando la guía del pedido.');
        }

        return redirect()
            ->route('logistica.pedidos')
            ->with('success',
                "Pedido #{$pedido->id} asignado a Camión #{$assignment['camion']->id_flota} " .
                "con Chofer #{$assignment['chofer']->id_usuario}. Guía #{$guias->first()->id} generada."
            );
    }


    public function historial()
    {
        $guias = GuiaDeRemision::with([
            'pedido.cliente.usuario',
            'flota.chofer.usuario',    // añadimos .usuario aquí
        ])
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

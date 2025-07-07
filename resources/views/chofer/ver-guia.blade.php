@extends('layouts.app')

@section('content')
    
    <h2 class="text-center font-extrabold text-blue-900 mb-10" style="font-size: 2rem;">
        📄 Detalle de Guía de Remisión
    </h2>


    {{-- Sección general --}}
    <div class="bg-white shadow-lg rounded-3xl border p-6 mb-6">
        <h4 class="text-xl font-bold mb-3 text-blue-800">📦 Datos Generales</h4>
        <p><strong>Guía ID:</strong> {{ $guia->id }}</p>
        <p><strong>Pedido ID:</strong> {{ $guia->pedido_id }}</p>
        <p><strong>Fecha de Envío:</strong> {{ \Carbon\Carbon::parse($guia->fecha_envio)->format('d-m-Y H:i') }}</p>
        <p><strong>Entrega Estimada:</strong> {{ \Carbon\Carbon::parse($guia->fecha_envio)->addHours(24)->format('d-m-Y H:i') }}</p>
        <p><strong>Ruta:</strong> {{ $guia->punto_partida }} → {{ $guia->punto_llegada }}</p>
        <p><strong>Estado del Pedido:</strong>
            @php
                $iconos = [
                    'pendiente'  => '⏳',
                    'facturado'  => '🧾',
                    'enviado'    => '🚚',
                    'entregado'  => '✅',
                    'cancelado'  => '❌',
                ];
                $estado = $guia->pedido->estado;
                $colores = [
                    'pendiente'  => 'bg-yellow-200 text-black',
                    'facturado'  => 'bg-blue-200 text-black',
                    'enviado'    => 'bg-orange-200 text-black',
                    'entregado'  => 'bg-green-200 text-black',
                    'cancelado'  => 'bg-red-200 text-black',
                ];
            @endphp
            <span class="inline-block px-3 py-1 rounded shadow-sm font-semibold text-sm {{ $colores[$estado] ?? 'bg-gray-200 text-black' }}">
                {{ $iconos[$estado] ?? '❓' }} {{ ucfirst($estado) }}
            </span>
        </p>

    </div>

    {{-- Cliente y Chofer --}}
    <div class="bg-white shadow-lg rounded-3xl border p-6 mb-6">
        <h4 class="text-xl font-bold mb-3 text-blue-800">👥 Cliente y Transportista</h4>
        <p><strong>Cliente:</strong> {{ optional($guia->pedido->cliente->usuario)->nombre ?? 'N/A' }}</p>
        <p><strong>Chofer:</strong> {{ optional(optional($guia->flota->chofer)->usuario)->nombre ?? 'No asignado' }}</p>
    </div>

    {{-- Camión asignado --}}
    <div class="bg-white shadow-lg rounded-3xl border p-6 mb-6">
        <h4 class="text-xl font-bold mb-3 text-blue-800">🚛 Camión Asignado</h4>
        <p><strong>Placa:</strong> {{ $guia->flota->placa }}</p>
        <p><strong>Marca:</strong> {{ $guia->flota->marca }}</p>
        <p><strong>Modelo:</strong> {{ $guia->flota->modelo ?? 'No definido' }}</p>
        <p><strong>Capacidad Total (m³):</strong>
            {{ number_format(($guia->flota->alto_contenedor * $guia->flota->ancho_contenedor * $guia->flota->largo_contenedor) / 1000000, 2) }}
        </p>
    </div>

    {{-- Productos --}}
    <div class="bg-white shadow-lg rounded-3xl border p-6 mb-6">
        <h4 class="text-xl font-bold mb-4 text-blue-800">📋 Productos del Pedido</h4>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Volumen Total (cm³)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guia->pedido->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ $detalle->producto->unidad ?? 'u.' }}</td>
                        <td>{{ $detalle->calcularVolumenTotal() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Botones de acción --}}
    <div class="text-center mt-5 d-flex justify-content-center gap-4 flex-wrap">
        <form action="{{ route('chofer.pedido.entregado', $guia->pedido_id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-lg shadow">
                ✅ Marcar como Entregado
            </button>
        </form>

        <form action="{{ route('chofer.pedido.cancelado', $guia->pedido_id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger btn-lg shadow">
                ❌ Marcar como Cancelado
            </button>
        </form>

        <a href="{{ route('chofer.guias') }}" class="btn btn-secondary btn-lg shadow">
            🔙 Volver a Guías Asignadas
        </a>
    </div>
</div>
@endsection

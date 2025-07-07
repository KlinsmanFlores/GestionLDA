@extends('layouts.app')

@section('content')
<div class="container py-6">
    <h2 class="text-center font-extrabold text-blue-900 mb-10" style="font-size: 2rem;">
    🛻 Guías Asignadas al Transportista
</h2>

    @if($guias->isEmpty())
        <div class="alert alert-info text-center text-lg text-black">
            No tienes guías asignadas actualmente.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow text-black text-sm">
                <thead class="bg-blue-100 text-black uppercase font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">Guía</th>
                        <th class="px-4 py-3 text-left">Pedido</th>
                        <th class="px-4 py-3 text-left">Fecha Envío</th>
                        <th class="px-4 py-3 text-left">Destino</th>
                        <th class="px-4 py-3 text-left">Vehículo</th>
                        <th class="px-4 py-3 text-left">Chofer</th>
                        <th class="px-4 py-3 text-left">Estado</th>
                        <th class="px-4 py-3 text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guias as $guia)
                        @php
                            $estado = $guia->pedido->estado;
                            $color = match($estado) {
                                'pendiente'  => 'bg-yellow-100 text-yellow-900',
                                'facturado'  => 'bg-blue-100 text-blue-900',
                                'enviado'    => 'bg-indigo-100 text-indigo-900',
                                'entregado'  => 'bg-green-100 text-green-900',
                                'cancelado'  => 'bg-red-100 text-red-900',
                                default      => 'bg-gray-100 text-gray-800',
                            };
                            $icono = match($estado) {
                                'pendiente'  => '⏳',
                                'facturado'  => '🧾',
                                'enviado'    => '🚚',
                                'entregado'  => '✅',
                                'cancelado'  => '❌',
                                default      => '❓',
                            };
                            $fechaEnvio = \Carbon\Carbon::parse($guia->fecha_envio);
                            $tiempoEntrega = $fechaEnvio->copy()->addHours(2); // estimado
                        @endphp
                        <tr class="border-t hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-3 font-medium">#{{ $guia->id }}</td>
                            <td class="px-4 py-3">#{{ $guia->pedido_id }}</td>
                            <td class="px-4 py-3">
                                {{ $fechaEnvio->format('d/m/Y H:i') }}<br>
                                <span class="text-xs text-gray-500">Hace {{ $fechaEnvio->diffForHumans() }}</span><br>
                                <span class="text-xs text-green-700">⏱ Entrega estimada: {{ $tiempoEntrega->format('H:i') }}</span>
                            </td>
                            <td class="px-4 py-3">{{ $guia->punto_llegada }}</td>
                            <td class="px-4 py-3">
                                {{ $guia->flota->marca ?? '—' }}<br>
                                <span class="text-xs text-gray-500">{{ $guia->flota->placa ?? '' }}</span>
                            </td>
                            <td class="px-4 py-3">
                                {{ optional(optional($guia->flota->chofer)->usuario)->nombre ?? '—' }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1 {{ $color }}">
                                    {{ $icono }} {{ ucfirst($estado) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('chofer.guia.detalle', $guia->id) }}"
                                   class="inline-block px-4 py-2 bg-blue-600 text-black rounded-lg text-xs font-semibold hover:bg-blue-700 transition">
                                    📄 Ver Detalle
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

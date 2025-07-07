@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h1 class="text-5xl font-extrabold text-center text-blue-800 mb-12">
        📋 Resumen de Guía de Remisión
    </h1>

    {{-- Datos principales de la guía --}}
    <div class="bg-white border-l-4 border-blue-600 shadow-lg rounded-2xl p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800">
            <p><strong>📄 Guía ID:</strong> {{ $guia->id }}</p>
            <p><strong>🧾 Pedido ID:</strong> {{ $guia->pedido_id }}</p>
            <p><strong>🕒 Fecha de Envío:</strong>
                {{ \Carbon\Carbon::parse($guia->fecha_envio)->format('d/m/Y H:i') }}
            </p>
            <p><strong>📍 Punto de Partida:</strong> {{ $guia->punto_partida }}</p>
            <p><strong>📦 Punto de Llegada:</strong> {{ $guia->punto_llegada }}</p>
            <p><strong>👤 Cliente:</strong>
                {{ optional($guia->pedido->cliente->usuario)->nombre ?? 'No registrado' }}
            </p>
        </div>
    </div>

    {{-- Datos del camión asignado --}}
    @if($guia->flota)
        <div class="bg-white border-l-4 border-yellow-500 shadow-lg rounded-2xl p-6 mb-8">
            <h2 class="text-2xl font-bold text-yellow-700 mb-4">🚛 Camión Asignado</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800">
                <p><strong>🔢 Placa:</strong> {{ $guia->flota->placa }}</p>
                <p><strong>🏷 Marca:</strong> {{ $guia->flota->marca }}</p>
                @if(optional($guia->flota)->modelo)
                    <p><strong>🛠 Modelo:</strong> {{ $guia->flota->modelo }}</p>
                @endif
                <p><strong>🧑‍✈️ Conductor:</strong>
                    {{ optional(optional($guia->flota->chofer)->usuario)->nombre ?? 'No asignado' }}
                </p>
            </div>
        </div>
    @endif

    {{-- Productos del pedido --}}
    @if($guia->pedido && $guia->pedido->detalles)
        <div class="bg-white border-l-4 border-green-600 shadow-lg rounded-2xl p-6 mb-8">
            <h2 class="text-2xl font-bold text-green-700 mb-4">📦 Productos Incluidos</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                @foreach($guia->pedido->detalles as $detalle)
                    <li>
                        {{ $detalle->producto->nombre ?? 'Producto desconocido' }} —
                        {{ $detalle->cantidad }} unidad(es)
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Enlace de retorno --}}
    <div class="text-center mt-10">
        <a href="{{ route('logistica.historial') }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-black font-semibold px-6 py-3 rounded-lg transition">
            ← Volver al Historial de Guías
        </a>
    </div>
</div>
@endsection

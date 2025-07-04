@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Resumen de Guía de Remisión</h1>

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <p><strong>Guía ID:</strong> {{ $guia->id }}</p>
        <p><strong>Pedido ID:</strong> {{ $guia->pedido_id }}</p>
        <p><strong>Fecha de Envío:</strong>
            {{ \Carbon\Carbon::parse($guia->fecha_envio)->format('d-m-Y H:i') }}
        </p>
        <p><strong>Punto de Partida:</strong> {{ $guia->punto_partida }}</p>
        <p><strong>Punto de Llegada:</strong> {{ $guia->punto_llegada }}</p>
    </div>

    @if($guia->flota)
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Datos del Camión Asignado</h2>
            <p><strong>Placa:</strong> {{ $guia->flota->placa }}</p>
            <p><strong>Marca:</strong> {{ $guia->flota->marca }}</p>
            @if(optional($guia->flota)->modelo)
                <p><strong>Modelo:</strong> {{ $guia->flota->modelo }}</p>
            @endif
        </div>
    @endif

    <a href="{{ route('logistica.historial') }}" class="inline-block mt-4 text-blue-600 hover:underline">
        Volver al Historial de Guías
    </a>
</div>
@endsection

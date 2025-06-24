@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6" style="font-size: 25pt;">Guía de Remisión Generada</h2>

    <div class="bg-white shadow rounded p-6 mb-4">
        <p><strong>Guía ID:</strong> {{ $guia->id }}</p>
        <p><strong>Pedido ID:</strong> {{ $guia->pedido_id }}</p>
        <p><strong>Fecha de Envío:</strong> {{ $guia->fecha_envio }}</p>
        <p><strong>Punto de Partida:</strong> {{ $guia->punto_partida }}</p>
        <p><strong>Punto de Llegada:</strong> {{ $guia->punto_llegada }}</p>
    </div>

    @if ($guia->flota)
        <div class="bg-white shadow rounded p-6 mb-4">
            <h3 class="text-lg font-semibold mb-2">Camión Asignado</h3>
            <p><strong>Placa:</strong> {{ $guia->flota->placa }}</p>
            <p><strong>Marca:</strong> {{ $guia->flota->marca }}</p>
            <p><strong>Modelo:</strong> {{ $guia->flota->modelo ?? 'No definido' }}</p>

            @php
                $volumen_cm3 = $guia->flota->alto_contenedor * $guia->flota->ancho_contenedor * $guia->flota->largo_contenedor;
                $volumen_m3 = $volumen_cm3 / 1000000;
            @endphp

            <p><strong>Volumen Contenedor (m³):</strong> {{ number_format($volumen_m3, 2) }}</p>
        </div>
    @else
        <div class="bg-red-100 text-red-700 p-4 rounded">
            <strong>Error:</strong> No se encontró información del camión asignado.
        </div>
    @endif

    <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded">
        <strong>El pedido ha sido marcado como "Enviado".</strong>
    </div>
</div>
@endsection

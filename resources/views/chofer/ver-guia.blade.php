@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-bold mb-4">Detalle de Guía</h2>

    <div class="bg-white shadow rounded p-4 mb-4">
        <p><strong>Guía ID:</strong> {{ $guia->id }}</p>
        <p><strong>Pedido ID:</strong> {{ $guia->pedido_id }}</p>
        <p><strong>Fecha de Envío:</strong> {{ $guia->fecha_envio }}</p>
        <p><strong>Destino:</strong> {{ $guia->punto_llegada }}</p>
    </div>

    <div class="bg-white shadow rounded p-4 mb-4">
        <h3 class="text-lg font-semibold mb-2">Camión Asignado</h3>
        <p><strong>Placa:</strong> {{ $guia->flota->placa }}</p>
        <p><strong>Marca:</strong> {{ $guia->flota->marca }}</p>
        <p><strong>Modelo:</strong> {{ $guia->flota->modelo ?? 'No definido' }}</p>
        <p><strong>Capacidad (m³):</strong> {{ ($guia->flota->alto_contenedor * $guia->flota->ancho_contenedor * $guia->flota->largo_contenedor) / 1000000 }}</p>
    </div>

    <div class="flex gap-4">
        <form action="{{ route('chofer.pedido.entregado', $guia->pedido_id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Marcar como Entregado</button>
        </form>

        <form action="{{ route('chofer.pedido.cancelado', $guia->pedido_id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Marcar como Cancelado</button>
        </form>
    </div>
</div>
@endsection

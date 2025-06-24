@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Camión Asignado</h2>
    <p><strong>Pedido:</strong> {{ $pedido->id }}</p>
    <p><strong>Camión:</strong> {{ $camion->placa }} - Capacidad: {{ $camion->capacidad_volumen }} m³</p>
    <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
</div>
@endsection

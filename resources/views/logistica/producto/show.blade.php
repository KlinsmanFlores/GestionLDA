@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-xl">
    <div class="bg-white p-6 rounded-xl shadow space-y-4">
        <h2 class="text-3xl font-bold text-center text-indigo-700 mb-6">📋 Detalle del Producto</h2>

        <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
        <p><strong>Peso:</strong> {{ $producto->peso }} kg</p>
        <p><strong>Unidad de medida:</strong> {{ $producto->unidad_medida }}</p>
        <p><strong>Dimensiones (cm):</strong> {{ $producto->alto }} x {{ $producto->ancho }} x {{ $producto->largo }}</p>
        <p><strong>PVP:</strong> S/ {{ number_format($producto->pvp, 2) }}</p>
        <p><strong>Stock:</strong> {{ $producto->stock_mano }} en almacén, {{ $producto->stock_transito }} en tránsito</p>

        <div class="text-center mt-6">
            <a href="{{ route('producto.index') }}" class="bg-indigo-600 text-black px-5 py-2 rounded hover:bg-indigo-700">Volver</a>
        </div>
    </div>
</div>
@endsection

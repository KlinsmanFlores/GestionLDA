@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">Pedidos Pendientes de Envío</h2>

    {{-- Mensaje de éxito si existe --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    @forelse($pedidos as $pedido)
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><strong>Pedido ID:</strong> {{ $pedido->id }}</p>
            <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre ?? 'N/A' }}</p>

            <p class="mt-2 font-semibold">Productos:</p>
            <ul class="list-disc pl-5">
                @foreach($pedido->detalles as $detalle)
                    <li>{{ $detalle->producto->nombre }} - {{ $detalle->cantidad }} unidades</li>
                @endforeach
            </ul>

            <form action="{{ route('logistica.asignar.camion', $pedido->id) }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-primary me-md-2" type="button">
                    Asignar Camión
                </button>
            </form>
        </div>
    @empty
        <p>No hay pedidos pendientes de envío.</p>
    @endforelse
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">Pedidos Facturados para Enviar a Logística</h2>

    {{-- Mensaje flash de éxito --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    @forelse($pedidos as $pedido)
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><strong>Pedido ID:</strong> {{ $pedido->id }}</p>
            <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre ?? 'N/A' }}</p>
            <p><strong>Productos:</strong></p>
            <ul class="list-disc pl-5">
                @foreach($pedido->detalles as $detalle)
                    <li>{{ $detalle->producto->nombre }} - {{ $detalle->cantidad }} unidades</li>
                @endforeach
            </ul>
            <form action="{{ route('vendedor.confirmar.factura', $pedido->id) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-primary">Enviar a logística</button>
            </form>
        </div>
    @empty
        <p>No hay pedidos facturados pendientes de envío.</p>
    @endforelse
</div>
@endsection
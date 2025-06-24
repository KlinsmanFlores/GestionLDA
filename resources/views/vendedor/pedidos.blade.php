@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">Pedidos Pendientes por Facturar</h2>

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
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Confirmar Factura</button>
            </form>
        </div>
    @empty
        <p>No hay pedidos pendientes.</p>
    @endforelse
</div>
@endsection

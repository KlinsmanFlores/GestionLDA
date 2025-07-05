@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">Pedidos Facturados para Enviar a Logística</h2>

    {{-- Mensajes flash --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded">
            {{ session('error') }}
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

            <div class="flex space-x-2 mt-4">
                {{-- Enviar a logística --}}
                <form action="{{ route('vendedor.confirmar.factura', $pedido->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Enviar a logística
                    </button>
                </form>

                {{-- Eliminar pedido --}}
                <form action="{{ route('vendedor.pedidos.eliminar', $pedido->id) }}"
                        method="POST"
                        onsubmit="return confirm('¿Eliminar pedido #{{ $pedido->id }} con estado {{ $pedido->estado }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p>No hay pedidos facturados pendientes de envío.</p>
    @endforelse
</div>
@endsection

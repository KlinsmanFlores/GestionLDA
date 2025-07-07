@extends('layouts.app')

@section('title', 'Pedidos Facturados')

@section('content')
<style>
    .pedido-card {
        border-left: 5px solid #0d6efd;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .pedido-card:hover {
        transform: scale(1.01);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }

    .btn-action {
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        transform: scale(1.05);
    }

    .alert-success, .alert-danger {
        font-weight: 500;
    }
</style>

<div class="container my-5">
    <h2 class="fw-bold text-dark fs-4 mb-4">
        📦 Pedidos Facturados para Enviar a Logística
    </h2>

    {{-- Mensajes flash --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @forelse($pedidos as $pedido)
        <div class="bg-white p-4 rounded-4 shadow-sm mb-4 pedido-card">
            <p class="mb-1"><strong>Pedido ID:</strong> {{ $pedido->id }}</p>
            <p class="mb-1"><strong>Cliente:</strong> {{ $pedido->cliente?->usuario?->nombre ?? 'N/A' }}</p>

            <p class="mb-2"><strong>Productos:</strong></p>
            <ul class="mb-3 ps-4">
                @foreach($pedido->detalles as $detalle)
                    <li>{{ $detalle->producto->nombre }} - {{ $detalle->cantidad }} unidades</li>
                @endforeach
            </ul>

            <div class="d-flex gap-2 mt-3">
                {{-- Enviar a logística --}}
                <form action="{{ route('vendedor.confirmar.factura', $pedido->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-action">
                        📤 Enviar a logística
                    </button>
                </form>

                {{-- Eliminar pedido --}}
                <form action="{{ route('vendedor.pedidos.eliminar', $pedido->id) }}"
                    method="POST"
                    onsubmit="return confirm('¿Eliminar el pedido #{{ $pedido->id }} con estado {{ $pedido->estado }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-action">
                        🗑 Eliminar
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-center py-4 text-muted">
            <p>🚫 No hay pedidos facturados pendientes de envío.</p>
        </div>
    @endforelse
</div>
@endsection

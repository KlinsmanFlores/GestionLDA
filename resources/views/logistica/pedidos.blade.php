@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 px-4">
    <h1 class="text-center font-extrabold text-blue-800 mb-12" style="font-size: 40px;">
    📦 Logística — Pedidos Pendientes
</h1>

    {{-- Mensajes flash --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-200 text-black border border-green-400 shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 rounded-lg bg-red-200 text-black border border-red-400 shadow-sm">
            ❌ {{ session('error') }}
        </div>
    @endif

    {{-- Lista de pedidos --}}
    <div class="space-y-8">
        @forelse($pedidos as $pedido)
            <div class="bg-white border border-gray-300 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex flex-col md:flex-row justify-between gap-6">
                    {{-- Datos del pedido --}}
                    <div class="space-y-3">
                        <h2 class="text-2xl font-bold text-black flex items-center gap-2">
                            🚚 Pedido #{{ $pedido->id }}
                        </h2>
                        <p class="text-black"><strong>Cliente:</strong> {{ optional($pedido->cliente->usuario)->nombre ?? 'N/A' }}</p>
                        <p class="text-gray-700"><strong>📅 Fecha:</strong> {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</p>
                        <p class="text-gray-700">
                            <strong>📄 Estado de Factura:</strong>
                            <span class="font-semibold text-{{ $pedido->estado_factura === 'pendiente' ? 'red-600' : 'green-600' }}">
                                {{ ucfirst($pedido->estado_factura) }}
                            </span>
                        </p>

                        <div>
                            <p class="font-semibold text-black">🛒 Productos:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                @foreach($pedido->detalles as $detalle)
                                    <li>{{ $detalle->producto->nombre }} × {{ $detalle->cantidad }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Acción: Asignar camión --}}
                    <div class="flex items-center">
                        <form action="{{ route('logistica.asignar.camion', $pedido->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-warning fw-semibold text-dark px-4 py-2 shadow-sm">
                                🛻 Asignar Camión
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-20 text-lg">
                🚫 No hay pedidos pendientes de envío.
            </div>
        @endforelse
    </div>

    {{-- Botón ver historial --}}
    <div class="mt-12 text-center">
        <a href="{{ route('logistica.historial') }}"
           class="inline-block px-6 py-3 bg-indigo-600 text-black font-semibold rounded-lg hover:bg-indigo-700 transition">
            📋 Ver Pedidos Asignados
        </a>
    </div>
</div>
@endsection

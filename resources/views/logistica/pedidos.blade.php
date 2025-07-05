@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-extrabold mb-6 text-gray-800">
        Logística — Pedidos Pendientes
    </h1>

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6">
        @forelse($pedidos as $pedido)
            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6 flex justify-between items-start hover:shadow-lg transition-shadow duration-200">
                <div class="space-y-2">
                    <h2 class="text-xl font-semibold text-blue-600">
                        Pedido #{{ $pedido->id }}
                    </h2>
                    <p class="text-gray-700">
                        <span class="font-medium">Cliente:</span>
                        {{-- Navegamos Cliente → Usuario → nombre --}}
                        {{ optional($pedido->cliente->usuario)->nombre ?? 'N/A' }}
                    </p>
                    <div>
                        <p class="font-medium text-gray-800">Productos:</p>
                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                            @foreach($pedido->detalles as $detalle)
                                <li>{{ $detalle->producto->nombre }} × {{ $detalle->cantidad }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <form action="{{ route('logistica.asignar.camion', $pedido->id) }}" method="POST">
                    @csrf
                    <button
                        class="px-5 py-2 border-2 border-blue-600 rounded-lg bg-white text-black font-semibold hover:bg-blue-50 transition-colors duration-150"
                    >
                        Asignar Camión
                    </button>
                </form>
            </div>
        @empty
            <p class="text-center text-gray-500">No hay pedidos pendientes de envío.</p>
        @endforelse
    </div>

    <div class="mt-8 text-right">
        <a
            href="{{ route('logistica.historial') }}"
            class="inline-block px-6 py-3 bg-indigo-600 text-black font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-150"
        >
            Ver Pedidos Asignados
        </a>
    </div>
</div>
@endsection

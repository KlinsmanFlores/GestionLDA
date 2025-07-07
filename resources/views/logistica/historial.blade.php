@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h1 class="text-5xl font-extrabold text-center text-blue-800 mb-12">
        📑 Historial de Guías de Remisión
    </h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-800 border border-red-300 rounded">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($guias as $guia)
            <div class="bg-white border-2 border-blue-200 rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-[1.02]">
                <div class="bg-blue-50 px-6 py-4 border-b">
                    <h2 class="text-2xl font-bold text-blue-700 mb-1">
                        🚚 Guía #{{ $guia->id }}
                    </h2>
                    <p class="text-sm text-gray-600">
                        Pedido #{{ $guia->pedido_id }} — 
                        <span class="italic">{{ \Carbon\Carbon::parse($guia->fecha_envio)->format('d/m/Y H:i') }}</span>
                    </p>
                </div>

                <div class="px-6 py-5 space-y-2 text-gray-800">
                    <p><span class="font-medium">👤 Cliente:</span>
                        {{ optional($guia->pedido->cliente->usuario)->nombre ?? 'N/A' }}
                    </p>
                    <p><span class="font-medium">🧍‍♂️ Conductor:</span>
                        {{ optional(optional($guia->flota->chofer)->usuario)->nombre ?? '—' }}
                    </p>
                    <p><span class="font-medium">🚛 Vehículo:</span>
                        {{ $guia->flota->marca }} ({{ $guia->flota->placa }})
                    </p>
                    <p><span class="font-medium">📍 Ruta:</span>
                        {{ $guia->punto_partida }} → {{ $guia->punto_llegada }}
                    </p>
                </div>

                <div class="px-6 py-4 border-t bg-gray-50 flex justify-between">
                    <a href="{{ route('logistica.guia_resumen', $guia->id) }}"
                        class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                        🔍 Ver Detalle
                    </a>
                    <a href="{{ route('logistica.descargar.guia', $guia->id) }}"
                        class="text-sm font-semibold text-green-600 hover:text-green-800 transition">
                        📄 Descargar PDF
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8 text-gray-500 text-lg">
                🚫 No hay guías generadas aún.
            </div>
        @endforelse
    </div>

    <div class="mt-10 flex justify-center">
        {{ $guias->links() }}
    </div>
</div>
@endsection

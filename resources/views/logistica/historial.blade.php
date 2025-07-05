{{-- resources/views/logistica/historial.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-extrabold mb-6 text-gray-800">
        Logística — Historial de Guías de Remisión
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($guias as $guia)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-blue-600">
                        Guía #{{ $guia->id }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        Pedido #{{ $guia->pedido_id }} · {{ \Carbon\Carbon::parse($guia->fecha_envio)->format('d-m-Y H:i') }}
                    </p>
                </div>

                <div class="px-6 py-4 space-y-2">
                    <p>
                    <span class="font-medium">Cliente:</span>
                    {{ optional($guia->pedido->cliente->usuario)->nombre ?? 'N/A' }}
                    </p>
                    <p>
                    <span class="font-medium">Conductor:</span>
                    {{ optional($guia->flota->chofer)->nombre ?? '—' }}
                    </p>
                    <p>
                        <span class="font-medium">Vehículo:</span>
                        {{ $guia->flota->marca }}  
                        ({{ $guia->flota->placa }})
                    </p>
                    <p>
                        <span class="font-medium">Ruta:</span>
                        {{ $guia->punto_partida }} → {{ $guia->punto_llegada }}
                    </p>
                </div>

                <div class="px-6 py-4 border-t flex justify-end space-x-2">
                    <a href="{{ route('logistica.guia_resumen', $guia->id) }}"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                        Ver Detalle
                    </a>
                    <a href="{{ route('logistica.descargar.guia', $guia->id) }}"
                        class="text-sm font-medium text-green-600 hover:text-green-800">
                        Descargar PDF
                    </a>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">
                No hay guías generadas aún.
            </p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $guias->links() }}
    </div>
</div>
@endsection

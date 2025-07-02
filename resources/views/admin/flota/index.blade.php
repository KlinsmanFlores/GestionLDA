@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado con título y botón de creación -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Flota de Vehículos</h1>
        <a href="{{ route('admin.flota.create') }}"
        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-black rounded-lg">
        + Nuevo Vehículo
        </a>
    </div>

    <!-- Listado de vehículos en tarjetas -->
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($vehiculos as $v)
        <div class="bg-white rounded-2xl shadow-lg p-6 relative">
            {{-- ID del vehículo en la esquina --}}
            <span class="absolute top-2 right-3 text-sm font-bold text-gray-400">
            #{{ $v->id_flota }}
            </span>

            <h2 class="text-xl font-bold mb-2">{{ $v->marca }} ({{ $v->placa }})</h2>

            <ul class="text-gray-700 mb-4 space-y-1">
            <li><span class="font-medium">Capacidad:</span> {{ $v->capacidad_carga }} kg</li>
            <li><span class="font-medium">Peso Neto:</span> {{ $v->peso_neto }} kg</li>
            <li><span class="font-medium">Peso Bruto:</span> {{ $v->peso_bruto_vehicular }} kg</li>
            <li><span class="font-medium">Dimensiones (A×An×L):</span>
                {{ $v->alto_contenedor }}×{{ $v->ancho_contenedor }}×{{ $v->largo_contenedor }} cm
            </li>
            </ul>

            <div class="flex justify-between">
            <a href="{{ route('admin.flota.edit', $v) }}"
                class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-black rounded-lg text-sm">
                Editar
            </a>
            <form action="{{ route('admin.flota.destroy', $v) }}" method="POST" onsubmit="return confirm('¿Eliminar vehículo?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-black rounded-lg text-sm">
                Eliminar
                </button>
            </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="mt-8">
        {{ $vehiculos->links() }}
    </div>
</div>
@endsection

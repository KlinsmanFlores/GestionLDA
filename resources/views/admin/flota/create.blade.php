{{-- resources/views/admin/flota/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-lg bg-white p-6 rounded-2xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Registrar Nuevo Vehículo</h1>
        <a href="{{ route('admin.flota.index') }}"
            class="text-blue-600 hover:underline">
            ← Volver al listado
        </a>
        </div>

        <form action="{{ route('admin.flota.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            {{-- Marca --}}
            <div>
            <label for="marca" class="block text-sm font-medium text-gray-700">
                Marca
            </label>
            <input
                type="text"
                name="marca"
                id="marca"
                value="{{ old('marca') }}"
                class="w-full border border-gray-300 bg-gray-50 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('marca')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            {{-- Placa --}}
            <div>
            <label for="placa" class="block text-sm font-medium text-gray-700">
                Placa
            </label>
            <input
                type="text"
                name="placa"
                id="placa"
                value="{{ old('placa') }}"
                class="w-full border border-gray-300 bg-gray-50 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('placa')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            {{-- Peso Neto --}}
            <div>
            <label for="peso_neto" class="block text-sm font-medium text-gray-700">
                Peso Neto (kg)
            </label>
            <input
                type="number"
                name="peso_neto"
                id="peso_neto"
                step="0.1"
                value="{{ old('peso_neto') }}"
                class="w-full border border-gray-300 bg-gray-50 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('peso_neto')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            {{-- Peso Bruto Vehicular --}}
            <div>
            <label for="peso_bruto_vehicular" class="block text-sm font-medium text-gray-700">
                Peso Bruto Vehicular (kg)
            </label>
            <input
                type="number"
                name="peso_bruto_vehicular"
                id="peso_bruto_vehicular"
                step="0.1"
                value="{{ old('peso_bruto_vehicular') }}"
                class="w-full border border-gray-300 bg-gray-50 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('peso_bruto_vehicular')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            {{-- Capacidad de Carga --}}
            <div>
            <label for="capacidad_carga" class="block text-sm font-medium text-gray-700">
                Capacidad de Carga (kg)
            </label>
            <input
                type="number"
                name="capacidad_carga"
                id="capacidad_carga"
                step="0.1"
                value="{{ old('capacidad_carga') }}"
                class="w-full border border-gray-300 bg-gray-50 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('capacidad_carga')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            {{-- Dimensiones del Contenedor --}}
            <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="alto_contenedor" class="block text-sm font-medium text-gray-700">
                Alto (cm)
                </label>
                <input
                type="number"
                name="alto_contenedor"
                id="alto_contenedor"
                step="0.1"
                value="{{ old('alto_contenedor') }}"
                class="w-full border border-gray-300 bg-gray-50 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                @error('alto_contenedor')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="ancho_contenedor" class="block text-sm font-medium text-gray-700">
                Ancho (cm)
                </label>
                <input
                type="number"
                name="ancho_contenedor"
                id="ancho_contenedor"
                step="0.1"
                value="{{ old('ancho_contenedor') }}"
                class="w-full border border-gray-300 bg-gray-50 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                @error('ancho_contenedor')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="largo_contenedor" class="block text-sm font-medium text-gray-700">
                Largo (cm)
                </label>
                <input
                type="number"
                name="largo_contenedor"
                id="largo_contenedor"
                step="0.1"
                value="{{ old('largo_contenedor') }}"
                class="w-full border border-gray-300 bg-gray-50 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                @error('largo_contenedor')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            </div>

            {{-- Botón Guardar --}}
            <div class="pt-4">
            <button
                type="submit"
                class="w-full px-4 py-2 bg-green-500 hover:bg-green-600 text-black font-medium rounded-lg"
            >
                Guardar Vehículo
            </button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection

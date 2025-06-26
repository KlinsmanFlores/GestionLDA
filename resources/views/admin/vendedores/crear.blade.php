{{-- resources/views/admin/vendedores/crear.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-12 p-8 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Datos del Vendedor para {{ $usuario->nombre }} {{ $usuario->apellidos }}</h2>
    <form method="POST" action="{{ route('admin.vendedores.store') }}">
        @csrf
        <input type="hidden" name="id_usuario" value="{{ $usuario->id_usuario }}">

        <div class="mb-4">
            <label for="zona" class="block font-semibold text-sm text-gray-700">Zona de venta</label>
            <input id="zona" name="zona" type="text" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" placeholder="Zona de venta">
        </div>
        <div class="mb-4">
            <label for="comision" class="block font-semibold text-sm text-gray-700">Comisión (%)</label>
            <input id="comision" name="comision" type="number" step="0.01" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" placeholder="Ej. 5.00">
        </div>
        <div class="text-center">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-black px-6 py-2 rounded">Guardar Vendedor</button>
        </div>
    </form>
</div>
@endsection

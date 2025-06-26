{{-- resources/views/admin/logisticas/crear.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-12 p-8 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Datos de Logística para {{ $usuario->nombre }} {{ $usuario->apellidos }}</h2>
    <form method="POST" action="{{ route('admin.logisticas.store') }}">
        @csrf
        <input type="hidden" name="id_usuario" value="{{ $usuario->id_usuario }}">

        <div class="mb-4">
            <label for="almacen_base" class="block font-semibold text-sm text-gray-700">Almacén base</label>
            <input id="almacen_base" name="almacen_base" type="text" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" placeholder="Ubicación del almacén">
        </div>
        <div class="mb-4">
            <label for="area_asignada" class="block font-semibold text-sm text-gray-700">Área asignada</label>
            <input id="area_asignada" name="area_asignada" type="text" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" placeholder="Área asignada">
        </div>
        <div class="text-center">
            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-black px-6 py-2 rounded">Guardar Logística</button>
        </div>
    </form>
</div>
@endsection
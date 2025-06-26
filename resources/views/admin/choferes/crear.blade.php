{{-- resources/views/admin/choferes/crear.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-12 p-8 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Datos del Chofer para {{ $usuario->nombre }} {{ $usuario->apellidos }}</h2>
    <form method="POST" action="{{ route('admin.choferes.store') }}">
        @csrf
        <input type="hidden" name="id_usuario" value="{{ $usuario->id_usuario }}">

        <div class="mb-4">
            <label for="licencia" class="block font-semibold text-sm text-gray-700">Licencia</label>
            <input id="licencia" name="licencia" type="text" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" placeholder="Número de licencia">
        </div>
        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black px-6 py-2 rounded">Guardar Chofer</button>
        </div>
    </form>
</div>
@endsection
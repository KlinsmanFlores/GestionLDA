{{-- resources/views/admin/usuarios/crear.blade.php --}}
@extends('layouts.app')

@section('content')
<div id="usuario-form" data-initial-rol="{{ $id_rol }}" class="max-w-2xl mx-auto mt-12 bg-white shadow-md rounded-xl p-8 border border-gray-200">

    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
        👤 Registrar nuevo @if($id_rol == 3) Transportista @elseif($id_rol == 4) Vendedor @else Logística @endif
    </h2>

    <form method="POST" action="{{ route('admin.usuarios.store', ['id_rol' => $id_rol]) }}">
        @csrf
        <input type="hidden" name="id_rol" value="{{ $id_rol }}">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="nombre" class="block font-semibold text-sm text-gray-700">Nombre</label>
                <input id="nombre" name="nombre" type="text" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2">
            </div>
            <div>
                <label for="apellidos" class="block font-semibold text-sm text-gray-700">Apellidos</label>
                <input id="apellidos" name="apellidos" type="text" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2">
            </div>
            <div>
                <label for="dni" class="block font-semibold text-sm text-gray-700">DNI</label>
                <input id="dni" name="dni" type="text" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2">
            </div>
            <div>
                <label for="correo" class="block font-semibold text-sm text-gray-700">Correo</label>
                <input id="correo" name="correo" type="email" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2">
            </div>
            <div>
                <label for="telefono" class="block font-semibold text-sm text-gray-700">Teléfono</label>
                <input id="telefono" name="telefono" type="text" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2">
            </div>
            <div class="sm:col-span-2">
                <label for="contrasena" class="block font-semibold text-sm text-gray-700">Contraseña</label>
                <input id="contrasena" name="contrasena" type="password" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2">
            </div>

            
            {{-- Campos hijos --}}
            
            
            
        </div>

        <div class="mt-8 text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-6 py-3 rounded-lg shadow-md transition">Registrar</button>
        </div>
    </form>
</div>


@endsection
@extends('layouts.app') {{-- Puedes usar tu layout de admin si lo tienes --}}

@section('content')
<div class="max-w-2xl mx-auto mt-12 bg-white shadow-md rounded-xl p-8 border border-gray-200">

    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
        👤 Registrar nuevo trabajador
    </h2>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="nombre" class="block font-semibold text-sm text-gray-700">Nombre</label>
                <input id="nombre" name="nombre" type="text" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" required>
            </div>

            <div>
                <label for="apellidos" class="block font-semibold text-sm text-gray-700">Apellidos</label>
                <input id="apellidos" name="apellidos" type="text" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" required>
            </div>

            <div>
                <label for="dni" class="block font-semibold text-sm text-gray-700">DNI</label>
                <input id="dni" name="dni" type="text" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" required>
            </div>

            <div>
                <label for="correo" class="block font-semibold text-sm text-gray-700">Correo</label>
                <input id="correo" name="correo" type="email" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" required>
            </div>

            <div>
                <label for="telefono" class="block font-semibold text-sm text-gray-700">Teléfono</label>
                <input id="telefono" name="telefono" type="text" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2">
            </div>

            <div>
                <label for="contrasena" class="block font-semibold text-sm text-gray-700">Contraseña</label>
                <input id="contrasena" name="contrasena" type="password" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" required>
            </div>

            <div class="sm:col-span-2">
                <label for="rol" class="block font-semibold text-sm text-gray-700">Rol del trabajador</label>
                <select id="rol" name="id_rol" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" required>
                    <option value="">-- Selecciona --</option>
                    <option value="3">Transportista</option>
                    <option value="4">Vendedor</option>
                    <option value="5">Logística</option>
                </select>
            </div>
        </div>

        <div class="mt-8 text-center">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-6 py-3 rounded-lg shadow-md transition">
                Registrar
            </button>
        </div>
    </form>
</div>
@endsection

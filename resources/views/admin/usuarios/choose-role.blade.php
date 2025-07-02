{{-- resources/views/admin/usuarios/choose-role.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-12 p-8 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">¿Qué tipo de trabajador vas a crear?</h2>
    <div class="space-x-4">
            <a href="{{ route('admin.usuarios.create', ['id_rol' => 3]) }}"
            class="px-4 py-2 bg-blue-600 text-black rounded">Transportista</a>
            <a href="{{ route('admin.usuarios.create', ['id_rol' => 4]) }}"
            class="px-4 py-2 bg-green-600 text-black rounded">Vendedor</a>
            <a href="{{ route('admin.usuarios.create', ['id_rol' => 5]) }}"
            class="px-4 py-2 bg-yellow-600 text-black rounded">Logística</a>
            
            <a href="{{ route('admin.flota.index') }}"
            class="px-4 py-2 bg-purple-600 text-black rounded">
            Vehículos
</a>
    </div>
</div>
@endsection
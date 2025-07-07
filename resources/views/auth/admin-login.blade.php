@extends('layouts.app')

@section('title', 'Inicio de Sesión Administrativa')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-50">
    <div class="bg-green shadow-lg rounded p-5" style="width: 600%; max-width: 600px;">
        <h2 class="text-center mb-4 text-dark">Iniciar Sesión</h2>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Correo -->
            <div class="mb-3">
                <x-input-label for="correo" :value="__('Correo')" />
                <x-text-input id="correo" class="form-control" type="email" name="correo" :value="old('correo')" required autofocus />
                <x-input-error :messages="$errors->get('correo')" class="mt-2 text-danger" />
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <x-input-label for="contrasena" :value="__('Contraseña')" />
                <x-text-input id="contrasena" class="form-control" type="password" name="contrasena" required />
                <x-input-error :messages="$errors->get('contrasena')" class="mt-2 text-danger" />
            </div>

            <!-- Rol (cargo) -->
            <div class="mb-4">
                <x-input-label for="rol_seleccionado" :value="__('Selecciona tu cargo')" />
                <select name="rol_seleccionado" id="rol_seleccionado" class="form-select" required>
                    <option value="">-- Selecciona --</option>
                    <option value="1">Administrador</option>
                    <option value="3">Transportista</option>
                    <option value="4">Vendedor</option>
                    <option value="5">Logística</option>
                </select>
                <x-input-error :messages="$errors->get('rol_seleccionado')" class="mt-2 text-danger" />
            </div>

            <!-- Botón -->
            <div class="d-grid text-center">
                <x-primary-button class="btn btn-dark text-center">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection

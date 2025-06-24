<x-guest-layout>
    <form method="POST" action="{{ route('cliente.register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="nombre" value="Nombre" />
            <x-text-input id="nombre" name="nombre" type="text" required autofocus />
        </div>

        <!-- Apellidos -->
        <div class="mt-4">
            <x-input-label for="apellidos" value="Apellidos" />
            <x-text-input id="apellidos" name="apellidos" type="text" required />
        </div>

        <!-- DNI -->
        <div class="mt-4">
            <x-input-label for="dni" value="DNI" />
            <x-text-input id="dni" name="dni" type="text" required />
        </div>

        <!-- Correo -->
        <div class="mt-4">
            <x-input-label for="correo" value="Correo" />
            <x-text-input id="correo" name="correo" type="email" required />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="telefono" value="Teléfono" />
            <x-text-input id="telefono" name="telefono" type="text" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="contrasena" value="Contraseña" />
            <x-text-input id="contrasena" name="contrasena" type="password" required />
        </div>

        <!-- Confirmación -->
        <div class="mt-4">
            <x-input-label for="contrasena_confirmation" value="Confirmar contraseña" />
            <x-text-input id="contrasena_confirmation" name="contrasena_confirmation" type="password" required />
        </div>

        <div class="mt-6">
            <x-primary-button>Registrar Cliente</x-primary-button>
        </div>
    </form>
</x-guest-layout>

<x-guest-layout>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Correo -->
        <div>
            <x-input-label for="correo" :value="__('Correo')" />
            <x-text-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo')" required autofocus />
            <x-input-error :messages="$errors->get('correo')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="contrasena" :value="__('Contraseña')" />
            <x-text-input id="contrasena" class="block mt-1 w-full" type="password" name="contrasena" required />
            <x-input-error :messages="$errors->get('contrasena')" class="mt-2" />
        </div>

        <!-- Rol (cargo) -->
        <div class="mt-4">
            <x-input-label for="rol_seleccionado" :value="__('Selecciona tu cargo')" />
            <select name="rol_seleccionado" id="rol_seleccionado" class="block mt-1 w-full" required>
                <option value="">-- Selecciona --</option>
                <option value="1">Administrador</option>
                <option value="3">Transportista</option>
                <option value="4">Vendedor</option>
                <option value="5">Logística</option>
            </select>
            <x-input-error :messages="$errors->get('rol_seleccionado')" class="mt-2" />
        </div>

        <!-- Botón -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
    </form>
    
</x-guest-layout>

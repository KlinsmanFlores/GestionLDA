
<x-auth-layout>
    <div class="w-full max-w-xl text-white animate-fade-in">
        <h1 class="text-3xl font-bold mb-6 text-center">Regístrate en <span class="text-sky-400">GestiónLDA</span></h1>

        @if (session('error'))
            <div class="bg-red-500 text-white text-sm p-2 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('cliente.register') }}" class="grid grid-cols-1 gap-4 bg-[#1e293b] p-6 rounded-xl shadow-md">
            @csrf

            <div>
                <label for="nombre" class="block text-sm mb-1 text-gray-300">Nombre</label>
                <input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:ring-2 focus:ring-sky-400 outline-none" />
                @error('nombre')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="apellidos" class="block text-sm mb-1 text-gray-300">Apellidos</label>
                <input id="apellidos" name="apellidos" type="text" value="{{ old('apellidos') }}" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:ring-2 focus:ring-sky-400 outline-none" />
                @error('apellidos')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="dni" class="block text-sm mb-1 text-gray-300">DNI</label>
                <input id="dni" name="dni" type="text" value="{{ old('dni') }}" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:ring-2 focus:ring-sky-400 outline-none" />
                @error('dni')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="correo" class="block text-sm mb-1 text-gray-300">Correo</label>
                <input id="correo" name="correo" type="email" value="{{ old('correo') }}" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:ring-2 focus:ring-sky-400 outline-none" />
                @error('correo')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="telefono" class="block text-sm mb-1 text-gray-300">Teléfono</label>
                <input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}"
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:ring-2 focus:ring-sky-400 outline-none" />
                @error('telefono')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="contrasena" class="block text-sm mb-1 text-gray-300">Contraseña</label>
                <input id="contrasena" name="contrasena" type="password" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:ring-2 focus:ring-sky-400 outline-none" />
                @error('contrasena')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="contrasena_confirmation" class="block text-sm mb-1 text-gray-300">Confirmar contraseña</label>
                <input id="contrasena_confirmation" name="contrasena_confirmation" type="password" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:ring-2 focus:ring-sky-400 outline-none" />
            </div>

            <button type="submit"
                class="w-full py-2 px-4 mt-2 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-md transition">
                Registrarme
            </button>

            <p class="text-center text-sm text-gray-400 mt-4">
                ¿Ya tienes cuenta?
                <a href="{{ route('cliente.login.form') }}" class="text-sky-400 hover:underline">Iniciar sesión</a>
            </p>
        </form>
    </div>
</x-auth-layout>
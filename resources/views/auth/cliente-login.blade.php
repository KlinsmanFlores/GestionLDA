
<x-auth-layout>
    <div class="w-full max-w-md text-white animate-fade-in">
        <h1 class="text-3xl font-bold mb-6 text-center">Iniciar sesión en <span class="text-sky-400">GestiónLDA</span></h1>

        @if (session('error'))
            <div class="bg-red-500 text-white text-sm p-2 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-500 text-white text-sm p-2 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('cliente.login') }}" class="space-y-6 bg-[#1e293b] p-6 rounded-xl shadow-md">
            @csrf

            <div>
                <label for="correo" class="block text-sm mb-1 text-gray-300">Correo electrónico</label>
                <input id="correo" name="correo" type="email" value="{{ old('correo') }}" required autofocus
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:ring-2 focus:ring-sky-400 outline-none" />
                @error('correo')
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

            <button type="submit"
                class="w-full py-2 px-4 bg-sky-500 hover:bg-sky-600 transition text-white font-semibold rounded-md shadow">
                Iniciar sesión
            </button>

            <p class="text-center text-sm text-gray-400">
                ¿No tienes cuenta?
                <a href="{{ route('cliente.register.form') }}" class="text-sky-400 hover:underline">Regístrate aquí</a>
            </p>
        </form>
    </div>
</x-auth-layout>
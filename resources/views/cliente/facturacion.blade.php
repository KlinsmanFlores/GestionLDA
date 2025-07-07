@extends('layouts.cliente')

@section('contenido')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-md p-6">

            {{-- Logo --}}
            <div class="flex justify-center mb-6">
                <img src="{{ asset('img/logo2.png') }}" alt="Logo Empresa" class="h-16">
            </div>

            {{-- Mensaje informativo --}}
            <div class="mb-6 text-sm text-gray-700 bg-yellow-50 border-l-4 border-yellow-400 rounded p-4 shadow-sm">
                <strong>Nota:</strong> La factura se generará con los datos ingresados. Asegúrate de que estén correctos antes de continuar.
            </div>

            {{-- Encabezado --}}
            <h2 class="text-3xl font-extrabold text-indigo-700 text-center mb-8 border-b-2 pb-2">
                🧾 Datos de Facturación
            </h2>

            {{-- Formulario --}}
            <form action="{{ route('cliente.facturar.pagar', $pedido->id) }}" method="POST">
                @csrf
                <input type="hidden" name="serie" value="{{ $serie }}">
                <input type="hidden" name="nextCorrelativo" value="{{ $nextCorrelativo }}">

                {{-- RUC --}}
                <div class="mb-4">
                    <label for="ruc" class="block text-gray-800 font-medium mb-1">RUC</label>
                    <input id="ruc" name="ruc" type="text" maxlength="11"
                        value="{{ old('ruc') }}"
                        class="w-full px-4 py-2 border rounded @error('ruc') border-red-500 @enderror"
                        required>
                    @error('ruc')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Razón Social --}}
                <div class="mb-4">
                    <label for="razon_social" class="block text-gray-800 font-medium mb-1">Razón Social</label>
                    <input id="razon_social" name="razon_social" type="text"
                        value="{{ old('razon_social') }}"
                        class="w-full px-4 py-2 border rounded @error('razon_social') border-red-500 @enderror"
                        required>
                    @error('razon_social')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dirección Fiscal --}}
                <div class="mb-4">
                    <label for="direccion_fiscal" class="block text-gray-800 font-medium mb-1">Dirección Fiscal</label>
                    <input id="direccion_fiscal" name="direccion_fiscal" type="text"
                        value="{{ old('direccion_fiscal') }}"
                        class="w-full px-4 py-2 border rounded @error('direccion_fiscal') border-red-500 @enderror"
                        required>
                    @error('direccion_fiscal')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tipo de Cliente --}}
                <div class="mb-4">
                    <label for="tipo_cliente" class="block text-gray-800 font-medium mb-1">Tipo de Cliente</label>
                    <select id="tipo_cliente" name="tipo_cliente"
                        class="w-full px-4 py-2 border rounded @error('tipo_cliente') border-red-500 @enderror"
                        required>
                        <option value="">Seleccione...</option>
                        <option value="natural" {{ old('tipo_cliente')=='natural' ? 'selected':'' }}>Persona Natural</option>
                        <option value="juridica" {{ old('tipo_cliente')=='juridica' ? 'selected':'' }}>Persona Jurídica</option>
                    </select>
                    @error('tipo_cliente')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Referencia --}}
                <div class="mb-6">
                    <label for="referencia" class="block text-gray-800 font-medium mb-1">Referencia de Dirección</label>
                    <input id="referencia" name="referencia" type="text"
                        value="{{ old('referencia') }}"
                        class="w-full px-4 py-2 border rounded @error('referencia') border-red-500 @enderror">
                    @error('referencia')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Medio de Pago --}}
                <div class="mb-6">
                    <label for="medio_pago" class="block text-gray-800 font-medium mb-1">Medio de Pago</label>
                    <select id="medio_pago" name="medio_pago"
                        class="w-full px-4 py-2 border rounded @error('medio_pago') border-red-500 @enderror"
                        required>
                        <option value="">Seleccione...</option>
                        <option value="yape" {{ old('medio_pago')=='yape' ? 'selected':'' }}>Yape</option>
                        <option value="transferencia" {{ old('medio_pago')=='transferencia' ? 'selected':'' }}>Transferencia</option>
                        <option value="efectivo" {{ old('medio_pago')=='efectivo' ? 'selected':'' }}>Efectivo</option>
                    </select>
                    @error('medio_pago')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botón de envío --}}
                <div class="text-center mt-8">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-green-500 hover:bg-green-600 text-black font-semibold rounded-lg shadow transition">
                        💳 Confirmar y Pagar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

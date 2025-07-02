@extends('layouts.cliente')

@section('titulo', 'Resumen del Pedido')

@section('contenido')
<div
    class="min-h-screen bg-gray-100 p-6 flex gap-6"
    x-data="{ openId: null }"
    >
    {{-- Datos del cliente --}}
    <aside class="w-full md:w-1/3 bg-white rounded-lg shadow p-4">
        <p><strong>Cliente:</strong> {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</p>
        <p><strong>DNI:</strong> {{ Auth::user()->dni }}</p>
        <p><strong>Teléfono:</strong> {{ Auth::user()->telefono }}</p>
    </aside>

    {{-- Resumen de detalles --}}
    <main class="w-full md:w-2/3 bg-white rounded-2xl shadow-lg p-8 border border-gray-300">
        <h2 class="text-4xl font-extrabold text-center mb-8 text-gray-800">
        Resumen del Pedido
        </h2>

        {{-- Tabla de líneas --}}
        <section class="overflow-x-auto mb-6">
        <table class="table-auto w-full border border-gray-300 rounded-lg">
            <thead class="bg-blue-600 text-black text-lg">
            <tr>
                <th class="px-6 py-3">Código</th>
                <th class="px-6 py-3">Producto</th>
                <th class="px-6 py-3">Cantidad</th>
                <th class="px-6 py-3">Precio Unitario</th>
                <th class="px-6 py-3">Precio Total</th>
                <th class="px-6 py-3">Volumen (cm³)</th>
                <th class="px-6 py-3">Acciones</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
            @foreach ($pedido->detalles as $detalle)
                <tr class="hover:bg-gray-100">
                <td class="px-6 py-4">{{ $detalle->producto_id }}</td>
                <td class="px-6 py-4">{{ $detalle->producto->nombre }}</td>
                <td class="px-6 py-4">{{ $detalle->cantidad }}</td>
                <td class="px-6 py-4">{{ number_format($detalle->producto->pvp, 2) }}</td>
                <td class="px-6 py-4">{{ number_format($detalle->cantidad * $detalle->producto->pvp, 2) }}</td>
                <td class="px-6 py-4">{{ $detalle->volumen_total }}</td>
                <td class="px-6 py-4 inline-flex space-x-2 justify-center">
                    {{-- Editar (abre modal) --}}
                    <button
                    @click="openId = {{ $detalle->id }}"
                    class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-black rounded"
                    >
                    Editar
                    </button>

                    {{-- Eliminar con confirmación --}}
                    <form
                    action="{{ route('cliente.pedido.eliminarDetalle', $detalle) }}"
                    method="POST"
                    onsubmit="return confirm('¿Estás seguro de eliminar este producto?')"
                    >
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-black rounded"
                    >
                        Eliminar
                    </button>
                    </form>
                </td>
                </tr>

                {{-- Modal de edición --}}
                <div
                x-show="openId === {{ $detalle->id }}"
                x-cloak
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                @click.away="openId = null"
                >
                <div class="bg-white p-6 rounded-lg w-96" @click.stop>
                    <h3 class="text-xl font-bold mb-4">Editar cantidad</h3>
                    <form
                    action="{{ route('cliente.pedido.actualizarDetalle', $detalle) }}"
                    method="POST"
                    >
                    @csrf
                    @method('PUT')
                    <label for="cantidad" class="block mb-2 font-medium">Cantidad:</label>
                    <input
                        type="number"
                        name="cantidad"
                        id="cantidad"
                        min="1"
                        value="{{ $detalle->cantidad }}"
                        class="w-full border rounded p-2 mb-4"
                    >
                    @error('cantidad')
                        <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                    @enderror
                    <div class="flex justify-end space-x-2">
                        <button
                        type="button"
                        @click="openId = null"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                        >
                        Cancelar
                        </button>
                        <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700"
                        >
                        Guardar
                        </button>
                    </div>
                    </form>
                </div>
                </div>
            @endforeach
            </tbody>
        </table>
        </section>

        {{-- Totales calculados --}}
        <section class="bg-gray-50 border-t border-b border-gray-200 py-4 px-6 mb-6 space-y-2">
        <div class="flex justify-between text-gray-700">
            <span class="font-medium">Subtotal:</span>
            <span>S/ {{ number_format($subtotal, 2) }}</span>
        </div>
        <div class="flex justify-between text-gray-700">
            <span class="font-medium">IGV (18%):</span>
            <span>S/ {{ number_format($igv, 2) }}</span>
        </div>
        <div class="flex justify-between text-gray-900 text-xl font-bold">
            <span>Total:</span>
            <span>S/ {{ number_format($total, 2) }}</span>
        </div>
        <div class="flex justify-between text-gray-700">
            <span class="font-medium">Volumen total:</span>
            <span>{{ $volumen }} cm³</span>
        </div>
        <div class="flex justify-between text-gray-700">
            <span class="font-medium">Peso total:</span>
            <span>{{ $peso }} kg</span>
        </div>
        </section>

        {{-- Mensaje de éxito --}}
        <article class="bg-green-50 border-l-4 border-green-500 rounded-md p-6 mb-6">
        <p class="font-semibold flex items-center">
            <span class="mr-2 text-2xl">✅</span>
            Tu pedido ha sido registrado con éxito.
        </p>
        <p class="text-gray-600 mt-1">Será procesado por el área de ventas.</p>
        </article>

        {{-- Botones --}}
        <div class="mt-8 flex justify-between items-center">
        <a href="{{ route('cliente.pedido.crear') }}" class="btn btn-primary btn-lg">
            Volver al inicio
        </a>
        <a
            href="{{ route('cliente.facturar.form', $pedido->id) }}"
            class="btn btn-success btn-lg"
        >
            <i class="bi bi-credit-card-fill me-2"></i> Ir a Facturar
        </a>
        </div>
    </main>
</div>
@endsection

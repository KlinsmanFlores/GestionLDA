@extends('layouts.cliente')

@section('titulo', 'Resumen del Pedido')

@section('contenido')
<div class="container mx-auto px-4 py-10" x-data="{ openId: null }">
    <h2 class="text-center font-extrabold text-blue-900 mb-10" style="font-size: 2rem;">
        🧾 Resumen del Pedido
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Datos del cliente --}}
        <aside class="bg-white rounded-xl shadow-md p-6 border border-gray-200 space-y-3">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">👤 Detalles del Cliente</h3>
            <p><strong>Nombre:</strong> {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</p>
            <p><strong>DNI:</strong> {{ Auth::user()->dni }}</p>
            <p><strong>Teléfono:</strong> {{ Auth::user()->telefono }}</p>
        </aside>

        {{-- Resumen del pedido --}}
        <main class="md:col-span-2 bg-white rounded-2xl shadow-xl p-8 border border-gray-300">
            {{-- Tabla --}}
            <div class="overflow-x-auto mb-6">
                <table class="min-w-full divide-y divide-gray-300 text-sm">
                    <thead class="bg-indigo-100 text-indigo-800 uppercase font-semibold">
                        <tr>
                            @foreach (['Código','Producto','Cantidad','Precio Unit.','Total','Volumen','Acciones'] as $th)
                                <th class="px-4 py-3">{{ $th }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-800">
                        @foreach ($pedido->detalles as $detalle)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $detalle->producto_id }}</td>
                            <td class="px-4 py-3">{{ $detalle->producto->nombre }}</td>
                            <td class="px-4 py-3">{{ $detalle->cantidad }}</td>
                            <td class="px-4 py-3">S/ {{ number_format($detalle->producto->pvp, 2) }}</td>
                            <td class="px-4 py-3">S/ {{ number_format($detalle->cantidad * $detalle->producto->pvp, 2) }}</td>
                            <td class="px-4 py-3">{{ $detalle->volumen_total }} cm³</td>
                            <td class="px-4 py-3 flex gap-2 justify-center">
                                <button
                                    @click="openId = {{ $detalle->id }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded shadow text-xs">
                                    ✏️ Editar
                                </button>
                                <form action="{{ route('cliente.pedido.eliminarDetalle', $detalle) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este producto?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-xs">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal --}}
                        <div x-show="openId === {{ $detalle->id }}" x-cloak
                             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                             @click.away="openId = null">
                            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md" @click.stop>
                                <h4 class="text-xl font-bold text-indigo-700 mb-4">Editar cantidad</h4>
                                <form action="{{ route('cliente.pedido.actualizarDetalle', $detalle) }}" method="POST" class="space-y-4">
                                    @csrf @method('PUT')
                                    <input type="number" name="cantidad" min="1" value="{{ $detalle->cantidad }}"
                                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-indigo-300">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="openId = null"
                                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
                                            Cancelar
                                        </button>
                                        <button type="submit"
                                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-black rounded shadow">
                                            Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Totales --}}
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-300 shadow-sm space-y-2 text-gray-800">
                <div class="flex justify-between"><span>Subtotal:</span><span>S/ {{ number_format($subtotal, 2) }}</span></div>
                <div class="flex justify-between"><span>IGV (18%):</span><span>S/ {{ number_format($igv, 2) }}</span></div>
                <div class="flex justify-between font-bold text-lg text-gray-900">
                    <span>Total:</span><span>S/ {{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between"><span>Volumen Total:</span><span>{{ $volumen }} cm³</span></div>
                <div class="flex justify-between"><span>Peso Total:</span><span>{{ $peso }} kg</span></div>
            </div>

            {{-- Tiempo estimado de entrega --}}
            <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg shadow text-yellow-800">
                <p class="text-sm">
                    ⏱️ <strong>Tiempo estimado de entrega:</strong> entre <span class="font-semibold">2 y 3 días hábiles</span>.
                    Recibirás una notificación cuando tu pedido esté en camino.
                </p>
            </div>

            {{-- Mensaje de éxito --}}
            <div class="bg-green-100 border-l-4 border-green-500 rounded-lg p-4 my-6 text-green-800">
                <p class="font-semibold">✅ Tu pedido ha sido registrado correctamente.</p>
                <p class="text-sm text-gray-700">Será procesado por el área de ventas.</p>
            </div>

            {{-- Botones --}}
            <div class="flex justify-between mt-6">
                <a href="{{ route('cliente.pedido.crear') }}"
                   class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-lg shadow text-gray-800 font-semibold">
                   🔙 Volver al inicio
                </a>
                <a href="{{ route('cliente.facturar.form', $pedido->id) }}"
                   class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg shadow text-black font-semibold">
                   💳 Ir a Facturar
                </a>
            </div>
        </main>
    </div>
</div>
@endsection

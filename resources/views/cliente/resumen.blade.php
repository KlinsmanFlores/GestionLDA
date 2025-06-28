@extends('layouts.cliente')

@section('titulo', 'Resumen del Pedido')

@section('contenido')
<div class="min-h-screen bg-gray-100 p-6 flex gap-6">
    <aside class="w-full md:w-1/3 bg-white rounded-lg shadow p-4">
        <p><strong>Cliente:</strong> {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</p>
        <p><strong>DNI:</strong> {{ Auth::user()->dni }}</p>
        <p><strong>Teléfono:</strong> {{ Auth::user()->telefono }}</p>
    </aside>

    <main class="w-full md:w-2/3 bg-white rounded-2xl shadow-lg p-8 border border-gray-300">
        <h2 class="text-4xl font-extrabold text-center mb-8 text-gray-800">Resumen del Pedido</h2>

        <section class="overflow-x-auto mb-8">
            <table class="table-auto mx-auto border border-gray-300 rounded-lg">
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
                            <a href="{{ route('cliente.pedido.editarDetalle', $detalle) }}"
                                class="btn btn-warning">
                                Editar
                            </a>
                            <form action="{{ route('cliente.pedido.eliminarDetalle', $detalle) }}"
                                    method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <article class="bg-green-50 border-l-4 border-green-500 rounded-md p-6 mb-6">
            <p class="font-semibold flex items-center">
                <span class="mr-2 text-2xl">✅</span>
                Tu pedido ha sido registrado con éxito.
            </p>
            <p class="text-gray-600 mt-1">Será procesado por el área de ventas.</p>
        </article>

        <div class="mt-8 flex justify-between items-center">
            <a href="{{ route('cliente.pedido.crear') }}" class="btn btn-primary btn-lg">
                Volver al inicio
            </a>
            <a href="{{ route('cliente.facturar.form', $pedido->id) }}"
                class="btn btn-success btn-lg">
                <i class="bi bi-credit-card-fill me-2"></i> Ir a Facturar
            </a>
        </div>
    </main>
</div>
@endsection

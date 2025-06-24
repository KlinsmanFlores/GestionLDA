@extends('layouts.cliente')

@section('titulo', 'Resumen del Pedido')
@section('cabecera', 'Resumen del Pedido')

@section('contenido')
    <div class="bg-white p-8 rounded-2xl shadow-xl text-center max-w-2xl mx-auto mt-10 border border-gray-200">

        <div class="text-center mb-16 " style="background-color:white;">
            <p class="text-green-700 text-lg font-semibold">✅ Tu pedido ha sido registrado con éxito.</p>
            <p class="text-gray-600">Será procesado por el área de ventas.</p>
        </div>

        <div class="overflow-x-auto ">
            <table class="min-w-full table-auto text-sm text-left border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                <thead class="bg-gradient-to-r from-blue-500 to-blue-700 text-black">
                    <tr>
                        <th class="px-6 py-3 font-semibold">📦 Producto</th>
                        <th class="px-6 py-3 font-semibold">🔢 Cantidad</th>
                        <th class="px-6 py-3 font-semibold">📐 Volumen (cm³)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($pedido->detalles as $detalle)
                        <tr>
                            <td class="px-6 py-3">{{ $detalle->producto->nombre }}</td>
                            <td class="px-6 py-3">{{ $detalle->cantidad }}</td>
                            <td class="px-6 py-3">
                                {{ $detalle->producto->alto * $detalle->producto->ancho * $detalle->producto->largo * $detalle->cantidad }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <a href="/cliente/inicio" class="text-blue-700 hover:underline text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al inicio
            </a>

            <a href="{{ route('cliente.facturar.form', $pedido->id) }}"
                class="bg-600 text-black text-base font-semibold px-6 py-2 rounded-lg hover:bg-green-700 shadow-md transition-all duration-300">
                💳 Ir a Facturar
            </a>
        </div>
    </div>
@endsection

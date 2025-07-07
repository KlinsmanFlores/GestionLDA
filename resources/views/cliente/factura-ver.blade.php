@extends('layouts.cliente')

@section('titulo', 'Factura #' . $factura->serie . '-' . str_pad($factura->correlativo, 6, '0', STR_PAD_LEFT))

@section('contenido')
<div class="w-full max-w-3xl bg-white rounded-lg shadow-lg p-10 px-12 space-y-8">

    <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg p-10 px-12 space-y-8">

        {{-- Encabezado --}}
        <div class="flex justify-between items-start mb-10 border-b pb-6">
            <div class="flex items-center gap-4">
                <img src="{{ asset('img/logo2.png') }}" class="h-16" alt="Logo">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Gestión LDA</h1>
                    <p class="text-sm text-gray-600">RUC: 20123456789</p>
                    <p class="text-sm text-gray-600">Av. Arequipa 304 - Arequipa</p>
                    <p class="text-sm text-gray-600">gestionlda@example.com</p>
                </div>
            </div>

            <div class="text-right">
                <h2 class="text-3xl font-bold text-indigo-700">FACTURA</h2>
                <p class="text-lg font-mono text-gray-800">
                    #{{ $factura->serie }}-{{ str_pad($factura->correlativo, 6, '0', STR_PAD_LEFT) }}
                </p>
                <p class="text-sm text-gray-600 mt-1">
                    Fecha: {{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}
                </p>
            </div>
        </div>

        {{-- Cliente --}}
        <div class="grid grid-cols-2 gap-8 mb-10">
            <div>
                <h3 class="text-gray-700 font-semibold mb-2">Datos del Cliente</h3>
                <p><strong>RUC:</strong> {{ $factura->ruc }}</p>
                <p><strong>Razón Social:</strong> {{ $factura->razon_social }}</p>
                <p><strong>Dirección Fiscal:</strong> {{ $factura->direccion }}</p>
                <p><strong>Referencia:</strong> {{ $factura->cliente->referencia }}</p>
            </div>
            <div>
                <h3 class="text-gray-700 font-semibold mb-2">Detalles</h3>
                <p><strong>Tipo de Cliente:</strong> {{ ucfirst($factura->cliente->tipo_cliente) }}</p>
                <p><strong>Medio de Pago:</strong> {{ ucfirst($factura->medio_pago) }}</p>
                <p><strong>Pedido ID:</strong> {{ $pedido->id }}</p>
            </div>
        </div>

        {{-- Detalles del pedido --}}
        <div class="overflow-x-auto mb-10">
            <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="border px-3 py-2">Código</th>
                        <th class="border px-3 py-2">Producto</th>
                        <th class="border px-3 py-2">Cantidad</th>
                        <th class="border px-3 py-2">Precio Unitario</th>
                        <th class="border px-3 py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach($pedido->detalles as $d)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2">{{ $d->producto_id }}</td>
                            <td class="border px-3 py-2">{{ $d->producto->nombre }}</td>
                            <td class="border px-3 py-2">{{ $d->cantidad }}</td>
                            <td class="border px-3 py-2">S/ {{ number_format($d->producto->pvp, 2) }}</td>
                            <td class="border px-3 py-2">S/ {{ number_format($d->cantidad * $d->producto->pvp, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Totales --}}
        <div class="flex justify-end mb-10">
            <table class="text-right text-sm w-full max-w-xs">
                <tr>
                    <td class="text-gray-600 py-1">Subtotal:</td>
                    <td class="font-medium">S/ {{ number_format($factura->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td class="text-gray-600 py-1">IGV (18%):</td>
                    <td class="font-medium">S/ {{ number_format($factura->igv, 2) }}</td>
                </tr>
                <tr>
                    <td class="text-lg font-bold pt-2">Total:</td>
                    <td class="text-lg font-bold pt-2">S/ {{ number_format($factura->total, 2) }}</td>
                </tr>
            </table>
        </div>

        {{-- Botones --}}
        <div class="text-center mt-8 flex justify-center gap-4">
            <a href="{{ route('cliente.pedido.crear') }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-lg shadow transition">
               🛒 Hacer otro pedido
            </a>
            <a href="{{ route('cliente.factura.pdf', ['id' => $factura->id_facturacion]) }}"
               class="bg-blue-600 hover:bg-blue-700 text-black px-6 py-3 rounded-lg shadow transition">
               ⬇️ Descargar Factura
            </a>
        </div>
    </div>
</div>
@endsection

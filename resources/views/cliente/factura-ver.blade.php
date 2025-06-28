@extends('layouts.cliente')

@section('titulo', 'Factura #' . $factura->serie . '-' . str_pad($factura->correlativo, 6, '0', STR_PAD_LEFT))

@section('contenido')
<div class="min-h-screen bg-gray-100 p-6 flex justify-center">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg p-8">
        
        {{-- Encabezado --}}
        <div class="flex justify-between items-center mb-6">
        <img src="{{ asset('img/logo2.png') }}" class="h-16" alt="Logo">
        <div class="text-right">
            <h2 class="text-2xl font-bold">Factura</h2>
            <p class="font-mono">
            #{{ $factura->serie }}-{{ str_pad($factura->correlativo, 6, '0', STR_PAD_LEFT) }}
            </p>
            <p class="text-gray-600">
            {{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}
            </p>
        </div>
        </div>

        {{-- Emisor / Cliente --}}
        <div class="grid grid-cols-2 gap-6 mb-8">
        <div>
            <h3 class="font-semibold">De:</h3>
            <p>Gestión LDA</p>
            <p>Av. Arequipa 304</p>
            <p>gestionlda@example.com</p>
        </div>
        <div>
            <h3 class="font-semibold">Para:</h3>
            <p><strong>RUC:</strong> {{ $factura->ruc }}</p>
            <p><strong>Razón Social:</strong> {{ $factura->razon_social }}</p>
            <p><strong>Dirección:</strong> {{ $factura->direccion }}</p>
            <p><strong>Tipo Cliente:</strong> {{ ucfirst($factura->cliente->tipo_cliente) }}</p>
            <p><strong>Referencia:</strong> {{ $factura->cliente->referencia }}</p>
            <p><strong>Medio Pago:</strong> {{ ucfirst($factura->medio_pago) }}</p>
        </div>
        </div>

        {{-- Detalle de Pedido --}}
        <div class="overflow-x-auto mb-8">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">Código</th>
                <th class="border px-4 py-2">Producto</th>
                <th class="border px-4 py-2">Cantidad</th>
                <th class="border px-4 py-2">PU</th>
                <th class="border px-4 py-2">Subtotal</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($pedido->detalles as $d)
            <tr>
                <td class="border px-4 py-2">{{ $d->producto_id }}</td>
                <td class="border px-4 py-2">{{ $d->producto->nombre }}</td>
                <td class="border px-4 py-2">{{ $d->cantidad }}</td>
                <td class="border px-4 py-2">S/ {{ number_format($d->producto->pvp, 2) }}</td>
                <td class="border px-4 py-2">
                S/ {{ number_format($d->cantidad * $d->producto->pvp, 2) }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>

        {{-- Totales --}}
        <div class="flex justify-end space-y-1 flex-col mb-4">
        <p><strong>Subtotal:</strong> S/ {{ number_format($factura->subtotal, 2) }}</p>
        <p><strong>IGV (18%):</strong> S/ {{ number_format($factura->igv, 2) }}</p>
        <p class="text-lg font-bold"><strong>Total:</strong> S/ {{ number_format($factura->total, 2) }}</p>
        </div>

        {{-- Acción final --}}
        <div class="text-center mt-6">
        <a href="{{ route('cliente.pedido.crear') }}" class="btn btn-primary">
            Volver a Pedir
        </a>
        </div>
    </div>
    </div>
@endsection

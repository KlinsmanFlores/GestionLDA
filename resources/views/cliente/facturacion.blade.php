@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
        
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-indigo-700 flex items-center gap-2">
                🧾 Datos de Facturación
            </h2>
            <p class="text-sm text-gray-500 mt-1">Completa los datos para generar tu factura</p>
        </div>

        <form action="{{ route('cliente.facturar', $pedido->id) }}" method="POST">
            @csrf

            <!-- RUC -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">RUC</label>
                <input type="text" name="ruc" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>

            <!-- Razón Social -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Razón Social</label>
                <input type="text" name="razon_social" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>

            <!-- Dirección Fiscal -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Dirección Fiscal</label>
                <input type="text" name="direccion_fiscal" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>

            <!-- Medio de Pago -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-1">Medio de Pago</label>
                <select name="medio_pago" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
                    <option value="yape">Yape</option>
                    <option value="transferencia">Transferencia</option>
                    <option value="efectivo">Efectivo</option>
                </select>
            </div>

            <!-- Totales -->
            @php
                $subtotal = $pedido->detalles->sum(fn($d) => $d->cantidad * $d->producto->pvp);
                $igv = $subtotal * 0.18;
                $total = $subtotal + $igv;
            @endphp

            <div class="bg-gray-50 border border-gray-300 p-6 rounded-lg shadow-inner text-gray-800 mb-6">
                <p class="mb-2"><strong>Subtotal:</strong> S/ {{ number_format($subtotal, 2) }}</p>
                <p class="mb-2"><strong>IGV (18%):</strong> S/ {{ number_format($igv, 2) }}</p>
                <p class="text-lg font-bold text-indigo-800"><strong>Total a pagar:</strong> S/ {{ number_format($total, 2) }}</p>
            </div>

            <!-- Botón -->
            <div class="text-center">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-black font-semibold px-6 py-3 rounded-lg transition duration-200 shadow-md">
                    💳 Confirmar Facturación
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.cliente')

@section('titulo', 'Estado del Pedido')
@section('cabecera', 'Pedido en proceso')

@section('contenido')
<div class="bg-white p-8 rounded-2xl shadow-xl text-center max-w-2xl mx-auto mt-10 border border-gray-200">
    
    <div class="flex justify-center mb-4">
        <div class="bg-green-100 text-green-600 rounded-full p-4 text-3xl">
        ✅
        </div>
    </div>

    <h2 class="text-2xl font-bold text-green-700 mb-4">¡Gracias por tu pedido!</h2>

    <p class="text-lg text-gray-700 mb-3">
        Tu pedido <span class="font-semibold text-indigo-700">#{{ $pedido->id }}</span>
        ha sido registrado y está siendo procesado por el área de ventas.
    </p>

    <p class="text-gray-600 mb-6">
        Recibirás una confirmación cuando la factura esté generada y el envío programado.
    </p>
    

    <a href="{{ route('cliente.pedido.crear') }}"
        class="bg-indigo-600 hover:bg-indigo-700 text-black font-semibold px-6 py-3 rounded-lg shadow-md transition">
        🛒 Hacer otro pedido
    </a>


    <a href="{{ route('cliente.factura.mostrar', $factura) }}"
        class="bg-indigo-600 hover:bg-indigo-700 text-black font-semibold px-6 py-3 rounded-lg shadow-md transition">
        🛒 Ver factura
    </a>



    </div>
@endsection

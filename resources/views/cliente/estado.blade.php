@extends('layouts.cliente')

@section('titulo', 'Estado del Pedido')
@section('cabecera', 'Pedido en proceso')

@section('contenido')
<div class="bg-white p-10 rounded-2xl shadow-2xl text-center max-w-2xl mx-auto mt-12 border border-gray-300">

    {{-- Ícono superior --}}
    <div class="flex justify-center mb-6">
        <div class="bg-green-100 text-green-700 rounded-full p-5 text-5xl shadow-inner animate-bounce">
            ✅
        </div>
    </div>

    {{-- Título principal --}}
    <h2 class="text-3xl font-extrabold text-green-800 mb-6 tracking-wide">
        ¡Gracias por tu pedido!
    </h2>

    {{-- Mensaje de estado --}}
    <p class="text-lg text-gray-800 mb-4 leading-relaxed">
        Tu pedido <span class="font-semibold text-indigo-700">#{{ $pedido->id }}</span> ha sido registrado y está siendo procesado por el área de ventas.
    </p>

    <p class="text-gray-600 mb-8">
        Te notificaremos cuando la factura esté generada y el envío programado.
    </p>

    {{-- Barra de progreso animada --}}
    <div class="relative w-full bg-gray-200 rounded-full h-4 overflow-hidden mb-8 shadow-inner">
        <div class="absolute top-0 left-0 h-4 bg-indigo-500 animate-pulse w-3/5 rounded-full transition-all duration-700"></div>
    </div>

    {{-- Botones --}}
    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('cliente.pedido.crear') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-black font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
            🛒 Hacer otro pedido
        </a>

        <a href="{{ route('cliente.factura.mostrar', $factura) }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-black font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
            📄 Ver factura
        </a>
    </div>

</div>
@endsection

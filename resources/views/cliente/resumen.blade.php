@extends('layouts.cliente')

@section('titulo', 'Resumen del Pedido')

@section('contenido')
<div class="min-h-screen bg-gray-100 p-6 flex  gap-6">
    
    {{-- Columna izquierda (vacía por ahora) --}}
    <aside class="w-full md:w-1/3 bg-white rounded-lg shadow p-4">
        {{-- Espacio reservado para filtros o menú lateral --}}
        <p>por ver que implementar</p>
        <p>nombre</p>
        <p>apeldido</p>
        <p>cliente</p>
        
    </aside>

    {{-- Columna derecha --}}
    <main class="w-full md:w-2/3 bg-white rounded-2xl shadow-lg p-8 border border-gray-300">
        
        {{-- Título grande --}}
        <h2 class="text-4xl font-extrabold text-center mb-8 text-gray-800" style="font-size: 30px; font-family:'Times New Roman', Times, serif;"  >
            Resumen del Pedido
        </h2>

        {{-- Tabla centrada, ancho automático según contenido, con bordes --}}
        <section class="overflow-x-auto mb-8">
            <table class="table-auto mx-auto border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-black text-lg">
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-300">CODIGO</th>
                        <th class="px-6 py-3 border-b border-gray-300">IMAGEN</th>
                        <th class="px-6 py-3 border-b border-gray-300">📦 Producto</th>
                        <th class="px-6 py-3 border-b border-gray-300">🔢 Cantidad</th>
                        <th class="px-6 py-3 border-b border-gray-300">PRECIO UNITARIO</th>
                        <th class="px-6 py-3 border-b border-gray-300">PRECIO TOTAL</th>
                        <th class="px-6 py-3 border-b border-gray-300">📐 Volumen (POR VER) (cm³)</th>
                        <th class="px-6 py-3 border-b border-gray-300">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-base text-gray-700">
                    @foreach ($pedido->detalles as $detalle)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 border-b border-gray-200">
                            {{ $detalle->cantidad }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            {{ $detalle->cantidad }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            {{ $detalle->producto->nombre }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            {{ $detalle->cantidad }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            {{ $detalle->cantidad }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            {{ $detalle->cantidad }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            {{ $detalle->producto->alto
                             * $detalle->producto->ancho
                             * $detalle->producto->largo
                             * $detalle->cantidad }}
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200 text-center">
                            <button type="button"
                                    class="btn btn-danger">
                                ELIMINAR
                            </button>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        {{-- Mensaje de confirmación --}}
        <article class="bg-green-50 text-green-800 border-l-4 border-green-500 rounded-md p-6 mb-6 text-lg">
                <p class="font-semibold flex items-center">
                    <span class="mr-2 text-2xl">✅</span>
                    Tu pedido ha sido registrado con éxito.
                </p>
                <p class="text-gray-600 mt-1">Será procesado por el área de ventas.</p>
        </article>

        {{-- Botones en las esquinas --}}
            <div class="mt-8 flex justify-between items-center w-full">
                <a href="/cliente/inicio" style="margin-left: 2rem;"
                class="btn btn-primary btn-lg fs-4"
                role="button">                
                Volver al inicio
                </a>
                <a href="{{ route('cliente.facturar.form', $pedido->id) }}" style="margin-right: 2rem;"
                class="btn btn-success btn-lg d-inline-flex align-items-center"
                role="button">
                <i class="bi bi-credit-card-fill fs-4 me-2"></i>
                Ir a Facturar
                </a>
            </div>

    </main>
</div>
@endsection

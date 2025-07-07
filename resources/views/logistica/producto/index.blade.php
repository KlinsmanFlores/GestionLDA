@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-indigo-50 via-white to-indigo-100 py-10 px-4">
    <div class="container mx-auto max-w-6xl">

        {{-- Título --}}
        <h1 class="text-4xl font-extrabold text-center text-indigo-800 mb-10 tracking-wide drop-shadow-md">
            📦 Lista de Productos en Logística
        </h1>

        {{-- Botón crear producto --}}
        <div class="flex justify-end mb-6">
            <a href="{{ route('producto.create') }}"
               class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-black font-bold px-5 py-2 rounded-lg shadow-md transition">
                <i class="bi bi-plus-circle-fill text-lg"></i> Nuevo Producto
            </a>
        </div>

        {{-- Tabla --}}
        <div class="overflow-x-auto bg-white rounded-2xl shadow-xl border border-gray-300">
            <table class="min-w-full text-sm text-left text-gray-800 table-auto border-collapse">
                <thead class="bg-indigo-100 text-gray-700 uppercase text-xs border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 border-r">📛 Nombre</th>
                        <th class="px-6 py-3 border-r">📦 Unidad</th>
                        <th class="px-6 py-3 border-r">📊 Stock</th>
                        <th class="px-6 py-3 border-r">💰 Precio Venta (PVP)</th>
                        <th class="px-6 py-3 text-center">🛠️ Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                    <tr class="border-b hover:bg-indigo-50 transition-all duration-200 ease-in-out">
                        <td class="px-6 py-4 border-r font-semibold">{{ $producto->nombre }}</td>
                        <td class="px-6 py-4 border-r">{{ $producto->unidad_medida }}</td>
                        <td class="px-6 py-4 border-r text-center font-medium">{{ $producto->stock_mano }}</td>
                        <td class="px-6 py-4 border-r">S/ {{ number_format($producto->pvp, 2) }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex flex-col space-y-2 items-center">
                                {{-- Botón Ver --}}
                                <a href="{{ route('producto.show', $producto->id_producto) }}"
                                   class="inline-flex items-center px-4 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-semibold rounded-lg shadow transition">
                                    <i class="bi bi-eye-fill mr-2"></i> Ver
                                </a>

                                {{-- Botón Editar --}}
                                <a href="{{ route('producto.edit', $producto->id_producto) }}"
                                   class="inline-flex items-center px-4 py-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-sm font-semibold rounded-lg shadow transition">
                                    <i class="bi bi-pencil-fill mr-2"></i> Editar
                                </a>

                                {{-- Botón Eliminar --}}
                                <form action="{{ route('producto.destroy', $producto->id_producto) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-semibold rounded-lg shadow transition">
                                        <i class="bi bi-trash-fill mr-2"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center px-6 py-4 text-gray-500">
                            ❌ No hay productos registrados actualmente.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Footer de resumen --}}
            @if(count($productos) > 0)
            <div class="bg-indigo-50 border-t border-gray-300 px-6 py-3 text-sm text-gray-600 text-right rounded-b-2xl">
                Total de productos registrados: <span class="font-bold text-indigo-700">{{ count($productos) }}</span>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

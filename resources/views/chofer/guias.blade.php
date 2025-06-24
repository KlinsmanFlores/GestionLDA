@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-bold mb-4" style="font-size: 20pt;">Guías Asignadas</h2>

    @if($guias->isEmpty())
        <div class="alert alert-info">No tienes guías asignadas actualmente.</div>
    @else
        <table class="table-auto w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Guía ID</th>
                    <th class="px-4 py-2">Pedido ID</th>
                    <th class="px-4 py-2">Fecha de Envío</th>
                    <th class="px-4 py-2">Destino</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guias as $guia)
                    <tr class="text-center border-t">
                        <td class="px-4 py-2">{{ $guia->id }}</td>
                        <td class="px-4 py-2">{{ $guia->pedido_id }}</td>
                        <td class="px-4 py-2">{{ $guia->fecha_envio }}</td>
                        <td class="px-4 py-2">{{ $guia->punto_llegada }}</td>
                        <td class="px-4 py-2">{{ $guia->pedido->estado }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('chofer.guia.detalle', $guia->id) }}" class="btn btn-sm btn-primary">Ver Detalle</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

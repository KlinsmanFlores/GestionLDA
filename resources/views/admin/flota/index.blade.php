@extends('layouts.app')

@section('title', 'Flota de Vehículos')

@section('content')
<style>
    .card-vehiculo {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 5px solid #0d6efd;
    }

    .card-vehiculo:hover {
        transform: scale(1.015);
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
    }

    .btn-vehiculo {
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-vehiculo:hover {
        transform: scale(1.05);
    }

    .vehiculo-id {
        top: 12px;
        right: 16px;
        font-size: 0.85rem;
        color: #6c757d;
    }
</style>

<div class="container my-5">
    <!-- Encabezado con título e ícono -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark fs-3">
            🚚 Flota de Vehículos
        </h1>
        <a href="{{ route('admin.flota.create') }}" class="btn btn-primary btn-vehiculo">
            + Nuevo Vehículo
        </a>
    </div>

    <!-- Listado de tarjetas -->
    <div class="row g-4">
        @foreach($vehiculos as $v)
        <div class="col-md-6 col-lg-4">
            <div class="bg-white p-4 rounded-4 shadow-sm position-relative card-vehiculo h-100">
                <span class="position-absolute vehiculo-id fw-bold">
                    #{{ $v->id_flota }}
                </span>

                <h5 class="fw-bold text-dark mb-3">
                    {{ $v->marca }} ({{ $v->placa }})
                </h5>

                <ul class="list-unstyled text-muted mb-4">
                    <li><strong>Capacidad:</strong> {{ $v->capacidad_carga }} kg</li>
                    <li><strong>Peso Neto:</strong> {{ $v->peso_neto }} kg</li>
                    <li><strong>Peso Bruto:</strong> {{ $v->peso_bruto_vehicular }} kg</li>
                    <li><strong>Dimensiones (A×An×L):</strong><br>
                        {{ $v->alto_contenedor }}×{{ $v->ancho_contenedor }}×{{ $v->largo_contenedor }} cm
                    </li>
                </ul>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.flota.edit', $v) }}"
                        class="btn btn-warning btn-sm text-dark btn-vehiculo">
                        ✏️ Editar
                    </a>
                    <form action="{{ route('admin.flota.destroy', $v) }}" method="POST" onsubmit="return confirm('¿Eliminar vehículo?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm text-white btn-vehiculo">
                            🗑 Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="mt-5">
        {{ $vehiculos->links() }}
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Editar Vehículo')

@section('content')
<style>
    .vehiculo-edit-card {
        border-left: 6px solid #0d6efd;
        transition: all 0.3s ease;
    }

    .vehiculo-edit-card:hover {
        transform: scale(1.01);
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    .btn-update {
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-update:hover {
        transform: scale(1.03);
        background-color: #0b5ed7 !important;
        color: #fff !important;
    }
</style>

<div class="container my-5">
    <div class="bg-white p-5 rounded-4 shadow vehiculo-edit-card mx-auto" style="max-width: 750px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark fs-4">
                🛠️ Editar Vehículo #{{ $flota->id_flota }}
            </h2>
            <a href="{{ route('admin.flota.index') }}" class="text-primary text-decoration-none fw-semibold">
                ← Volver al listado
            </a>
        </div>

        <form action="{{ route('admin.flota.update', $flota) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                {{-- Marca --}}
                <div class="col-md-6">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" name="marca" id="marca" value="{{ old('marca', $flota->marca) }}"
                        class="form-control" placeholder="Ej. Isuzu">
                    @error('marca') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Placa --}}
                <div class="col-md-6">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" name="placa" id="placa" value="{{ old('placa', $flota->placa) }}"
                        class="form-control" placeholder="Ej. ABC-123">
                    @error('placa') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Peso Neto --}}
                <div class="col-md-6">
                    <label for="peso_neto" class="form-label">Peso Neto (kg)</label>
                    <input type="number" name="peso_neto" id="peso_neto" step="0.1"
                        value="{{ old('peso_neto', $flota->peso_neto) }}" class="form-control">
                    @error('peso_neto') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Peso Bruto --}}
                <div class="col-md-6">
                    <label for="peso_bruto_vehicular" class="form-label">Peso Bruto Vehicular (kg)</label>
                    <input type="number" name="peso_bruto_vehicular" id="peso_bruto_vehicular" step="0.1"
                        value="{{ old('peso_bruto_vehicular', $flota->peso_bruto_vehicular) }}" class="form-control">
                    @error('peso_bruto_vehicular') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Capacidad de Carga --}}
                <div class="col-md-6">
                    <label for="capacidad_carga" class="form-label">Capacidad de Carga (kg)</label>
                    <input type="number" name="capacidad_carga" id="capacidad_carga" step="0.1"
                        value="{{ old('capacidad_carga', $flota->capacidad_carga) }}" class="form-control">
                    @error('capacidad_carga') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Dimensiones --}}
                <div class="col-12">
                    <label class="form-label mb-2">Dimensiones del Contenedor (cm)</label>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="number" name="alto_contenedor" id="alto_contenedor" step="0.1"
                                value="{{ old('alto_contenedor', $flota->alto_contenedor) }}" class="form-control"
                                placeholder="Alto">
                            @error('alto_contenedor') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="ancho_contenedor" id="ancho_contenedor" step="0.1"
                                value="{{ old('ancho_contenedor', $flota->ancho_contenedor) }}" class="form-control"
                                placeholder="Ancho">
                            @error('ancho_contenedor') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="largo_contenedor" id="largo_contenedor" step="0.1"
                                value="{{ old('largo_contenedor', $flota->largo_contenedor) }}" class="form-control"
                                placeholder="Largo">
                            @error('largo_contenedor') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Botón actualizar --}}
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5 btn-update">
                    Actualizar Vehículo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

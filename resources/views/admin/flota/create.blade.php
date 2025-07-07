@extends('layouts.app')

@section('title', 'Registrar Vehículo')

@section('content')
<style>
    .vehiculo-form-card {
        border-left: 6px solid #198754;
        transition: all 0.3s ease;
    }

    .vehiculo-form-card:hover {
        transform: scale(1.01);
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
    }

    .form-label {
        font-weight: 600;
        color: #444;
    }

    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.15rem rgba(25, 135, 84, 0.25);
    }

    .btn-guardar {
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-guardar:hover {
        transform: scale(1.03);
        background-color: #157347 !important;
    }
</style>

<div class="container my-5">
    <div class="bg-white p-5 rounded-4 shadow vehiculo-form-card mx-auto" style="max-width: 750px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark fs-4">🚛 Registrar Nuevo Vehículo</h2>
            <a href="{{ route('admin.flota.index') }}" class="text-success text-decoration-none fw-semibold">
                ← Volver al listado
            </a>
        </div>

        <form action="{{ route('admin.flota.store') }}" method="POST">
            @csrf

            <div class="row g-4">
                {{-- Marca --}}
                <div class="col-md-6">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" name="marca" id="marca" value="{{ old('marca') }}"
                        class="form-control" placeholder="Ej. Volvo, Isuzu">
                    @error('marca')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Placa --}}
                <div class="col-md-6">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" name="placa" id="placa" value="{{ old('placa') }}"
                        class="form-control" placeholder="Ej. ABC-123">
                    @error('placa')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Peso Neto --}}
                <div class="col-md-6">
                    <label for="peso_neto" class="form-label">Peso Neto (kg)</label>
                    <input type="number" name="peso_neto" id="peso_neto" step="0.1"
                        value="{{ old('peso_neto') }}" class="form-control" placeholder="Ej. 1500">
                    @error('peso_neto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Peso Bruto Vehicular --}}
                <div class="col-md-6">
                    <label for="peso_bruto_vehicular" class="form-label">Peso Bruto Vehicular (kg)</label>
                    <input type="number" name="peso_bruto_vehicular" id="peso_bruto_vehicular" step="0.1"
                        value="{{ old('peso_bruto_vehicular') }}" class="form-control" placeholder="Ej. 3000">
                    @error('peso_bruto_vehicular')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Capacidad de Carga --}}
                <div class="col-md-6">
                    <label for="capacidad_carga" class="form-label">Capacidad de Carga (kg)</label>
                    <input type="number" name="capacidad_carga" id="capacidad_carga" step="0.1"
                        value="{{ old('capacidad_carga') }}" class="form-control" placeholder="Ej. 1200">
                    @error('capacidad_carga')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Dimensiones --}}
                <div class="col-12">
                    <label class="form-label mb-2">Dimensiones del Contenedor (cm)</label>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="number" name="alto_contenedor" id="alto_contenedor" step="0.1"
                                value="{{ old('alto_contenedor') }}" class="form-control" placeholder="Alto">
                            @error('alto_contenedor')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="ancho_contenedor" id="ancho_contenedor" step="0.1"
                                value="{{ old('ancho_contenedor') }}" class="form-control" placeholder="Ancho">
                            @error('ancho_contenedor')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="largo_contenedor" id="largo_contenedor" step="0.1"
                                value="{{ old('largo_contenedor') }}" class="form-control" placeholder="Largo">
                            @error('largo_contenedor')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Botón Guardar --}}
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-success btn-lg px-5 btn-guardar">
                    Guardar Vehículo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

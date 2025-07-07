@extends('layouts.app')

@section('title', 'Registrar Datos del Vendedor')

@section('content')
<style>
    .card-form {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-form:hover {
        transform: scale(1.01);
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.15rem rgba(25, 135, 84, 0.25);
    }

    .btn-save {
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        background-color: #157347 !important;
        transform: scale(1.03);
    }
</style>

<div class="container my-5">
    <div class="bg-white p-5 rounded-4 shadow-lg border border-light card-form mx-auto" style="max-width: 600px;">
        <h2 class="text-center fw-bold text-dark mb-4 fs-4">
            🧑‍💼 Datos del Vendedor para {{ $usuario->nombre }} {{ $usuario->apellidos }}
        </h2>

        <form method="POST" action="{{ route('admin.vendedores.store') }}">
            @csrf
            <input type="hidden" name="id_usuario" value="{{ $usuario->id_usuario }}">

            <div class="mb-4">
                <label for="zona" class="form-label">Zona de venta</label>
                <input id="zona" name="zona" type="text" required placeholder="Ej. Norte, Sur, Lima Centro" class="form-control">
            </div>

            <div class="mb-4">
                <label for="comision" class="form-label">Comisión (%)</label>
                <input id="comision" name="comision" type="number" step="0.01" required placeholder="Ej. 5.00" class="form-control">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg px-5 btn-save">
                    Guardar Vendedor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Registrar Logística')

@section('content')
<style>
    .logistica-card {
        border-left: 6px solid #facc15; /* amarillo Tailwind */
        transition: all 0.3s ease;
    }

    .logistica-card:hover {
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
        transform: scale(1.01);
    }

    .form-label {
        font-weight: 600;
        color: #444;
    }

    .form-control:focus {
        border-color: #facc15;
        box-shadow: 0 0 0 0.15rem rgba(251, 191, 36, 0.4);
    }

    .btn-logistica {
        background-color: #facc15;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-logistica:hover {
        background-color: #eab308;
        transform: scale(1.03);
        color: #000;
    }
</style>

<div class="container my-5">
    <div class="bg-white p-5 rounded-4 shadow logistica-card mx-auto" style="max-width: 600px;">
        <h2 class="text-center fw-bold text-dark mb-4 fs-4">
            🏬 Datos de Logística para {{ $usuario->nombre }} {{ $usuario->apellidos }}
        </h2>

        <form method="POST" action="{{ route('admin.logisticas.store') }}">
            @csrf
            <input type="hidden" name="id_usuario" value="{{ $usuario->id_usuario }}">

            <div class="mb-4">
                <label for="almacen_base" class="form-label">Almacén base</label>
                <input id="almacen_base" name="almacen_base" type="text" required class="form-control" placeholder="Ej. Arequipa, Lima Norte">
            </div>

            <div class="mb-4">
                <label for="area_asignada" class="form-label">Área asignada</label>
                <input id="area_asignada" name="area_asignada" type="text" required class="form-control" placeholder="Ej. Recepción, Distribución, Embalaje">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-logistica btn-lg px-5">
                    Guardar Logística
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

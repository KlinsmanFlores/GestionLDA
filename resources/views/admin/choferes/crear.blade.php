@extends('layouts.app')

@section('title', 'Registrar Chofer')

@section('content')
<style>
    .chofer-card {
        border-left: 6px solid #0d6efd; /* azul Bootstrap */
        transition: all 0.3s ease;
    }

    .chofer-card:hover {
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
        transform: scale(1.01);
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    .btn-chofer {
        background-color: #0d6efd;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-chofer:hover {
        background-color: #0b5ed7;
        transform: scale(1.03);
        color: #fff;
    }
</style>

<div class="container my-5">
    <div class="bg-white p-5 rounded-4 shadow chofer-card mx-auto" style="max-width: 600px;">
        <h2 class="text-center fw-bold text-dark mb-4 fs-4">
            🚗 Datos del Chofer para {{ $usuario->nombre }} {{ $usuario->apellidos }}
        </h2>

        <form method="POST" action="{{ route('admin.choferes.store') }}">
            @csrf
            <input type="hidden" name="id_usuario" value="{{ $usuario->id_usuario }}">

            <div class="mb-4">
                <label for="licencia" class="form-label">Licencia</label>
                <input id="licencia" name="licencia" type="text" required class="form-control" placeholder="Número de licencia">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-chofer btn-lg px-5">
                    Guardar Chofer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

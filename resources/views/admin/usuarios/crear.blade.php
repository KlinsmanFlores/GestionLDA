@extends('layouts.app')

@section('title', 'Registrar Usuario')

@section('content')
<style>
    .form-card {
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .form-card:hover {
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    .btn-submit {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-submit:hover {
        background-color: #0b5ed7;
        transform: scale(1.02);
    }
</style>

<div class="container my-5">
    <div class="bg-white p-5 shadow-lg rounded-4 border border-light form-card mx-auto" style="max-width: 700px;">
        <h2 class="text-center fw-bold text-dark mb-4 fs-4">
            @if($id_rol == 3)
                🚚 Registrar nuevo Transportista
            @elseif($id_rol == 4)
                🧍 Registrar nuevo Vendedor
            @else
                📦 Registrar nuevo Logística
            @endif
        </h2>

        <form method="POST" action="{{ route('admin.usuarios.store', ['id_rol' => $id_rol]) }}">
            @csrf
            <input type="hidden" name="id_rol" value="{{ $id_rol }}">

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input id="nombre" name="nombre" type="text" required class="form-control" />
                </div>

                <div class="col-md-6">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input id="apellidos" name="apellidos" type="text" required class="form-control" />
                </div>

                <div class="col-md-6">
                    <label for="dni" class="form-label">DNI</label>
                    <input id="dni" name="dni" type="text" required class="form-control" />
                </div>

                <div class="col-md-6">
                    <label for="correo" class="form-label">Correo</label>
                    <input id="correo" name="correo" type="email" required class="form-control" />
                </div>

                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input id="telefono" name="telefono" type="text" class="form-control" />
                </div>

                <div class="col-12">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input id="contrasena" name="contrasena" type="password" required class="form-control" />
                </div>

                {{-- Campos hijos --}}

            </div>

            <div class="mt-5 text-center">
                <button type="submit" class="btn btn-dark btn-lg px-5 btn-submit">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

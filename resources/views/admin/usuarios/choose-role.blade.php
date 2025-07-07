@extends('layouts.app')

@section('title', 'Crear Usuario o Unidad')

@section('content')
<style>
    .card-hover {
        transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .card-hover:hover {
        transform: scale(1.03);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .card-hover:hover .icon-blue {
        color: #0d6efd !important;
    }

    .card-hover:hover .icon-green {
        color: #198754 !important;
    }

    .card-hover:hover .icon-yellow {
        color: #ffc107 !important;
    }

    .card-hover:hover .icon-purple {
        color: #6f42c1 !important;
    }

    .icon-animated {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .card-hover:hover .icon-animated {
        transform: scale(1.3);
    }
</style>

<div class="container my-5">
    <div class="bg-white shadow rounded p-5 mx-auto" style="max-width: 800px;">
        <h2 class="text-center mb-5 text-dark fw-bold">Crear Usuario o Unidad</h2>

        <div class="row g-4">
            <div class="col-md-6">
                <a href="{{ route('admin.usuarios.create', ['id_rol' => 3]) }}" class="text-decoration-none">
                    <div class="card border-0 card-hover h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-truck display-4 text-secondary mb-3 icon-animated icon-blue"></i>
                            <h5 class="card-title text-dark">Transportista</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('admin.usuarios.create', ['id_rol' => 4]) }}" class="text-decoration-none">
                    <div class="card border-0 card-hover h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-person-badge display-4 text-secondary mb-3 icon-animated icon-green"></i>
                            <h5 class="card-title text-dark">Vendedor</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('admin.usuarios.create', ['id_rol' => 5]) }}" class="text-decoration-none">
                    <div class="card border-0 card-hover h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-box-seam display-4 text-secondary mb-3 icon-animated icon-yellow"></i>
                            <h5 class="card-title text-dark">Logística</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('admin.flota.index') }}" class="text-decoration-none">
                    <div class="card border-0 card-hover h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-truck-front-fill display-4 text-secondary mb-3 icon-animated icon-purple"></i>
                            <h5 class="card-title text-dark">Vehículos</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

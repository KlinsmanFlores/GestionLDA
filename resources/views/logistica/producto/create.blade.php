@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-2xl">
    <h2 class="text-3xl font-bold text-center text-green-700 mb-6">➕ Registrar Producto</h2>

    <form action="{{ route('producto.store') }}" method="POST" class="space-y-5 bg-white p-6 rounded-xl shadow">
        @csrf
        @include('logistica.producto.partials.form')

        <div class="text-center">
            <button type="submit" class="px-6 py-2 bg-green-600 text-black rounded hover:bg-green-700">
                Guardar Producto
            </button>
        </div>
    </form>
</div>
@endsection

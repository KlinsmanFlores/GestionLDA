@extends('layouts.cliente')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body px-5 py-4">
                    <h2 class="text-center text-success fw-bold mb-5">
                        🛒 Crear Nuevo Pedido
                    </h2>

                    <form method="POST" action="{{ route('cliente.pedido.guardar') }}">
                        @csrf

                        <div id="productos-container">
                            <div class="producto-group border rounded p-3 mb-4 bg-light-subtle shadow-sm">
                                <label class="form-label fw-semibold">🧾 Producto:</label>
                                <select name="productos[0][id]" class="form-select" required>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id_producto }}">
                                            {{ $producto->nombre }} ({{ $producto->unidad_medida }})
                                        </option>
                                    @endforeach
                                </select>

                                <label class="form-label mt-3 fw-semibold">🔢 Cantidad:</label>
                                <input type="number" name="productos[0][cantidad]" class="form-control" min="1" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4 flex-wrap gap-3">
                            <button type="button" onclick="agregarProducto()" class="btn btn-outline-warning fw-semibold px-4">
                                <i class="bi bi-plus-circle"></i> Agregar Producto
                            </button>

                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow">
                                <i class="bi bi-cart-check"></i> Registrar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let index = 1;
    function agregarProducto() {
        const container = document.getElementById('productos-container');
        const template = `
            <div class="producto-group border rounded p-3 mb-4 bg-light-subtle shadow-sm">
                <label class="form-label fw-semibold">🧾 Producto:</label>
                <select name="productos[${index}][id]" class="form-select" required>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id_producto }}">{{ $producto->nombre }} ({{ $producto->unidad_medida }})</option>
                    @endforeach
                </select>

                <label class="form-label mt-3 fw-semibold">🔢 Cantidad:</label>
                <input type="number" name="productos[${index}][cantidad]" class="form-control" min="1" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
        index++;
    }
</script>
@endsection

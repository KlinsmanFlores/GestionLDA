@extends('layouts.cliente')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow rounded-4">
                <div class="card-body">
                    <h3 class="mb-4 text-center text-primary fw-bold">Crear nuevo pedido</h3>

                    <form method="POST" action="{{ route('cliente.pedido.guardar') }}">
                        @csrf

                        <div id="productos-container">
                            <div class="producto-group mb-4">
                                <label class="form-label fw-semibold">Producto:</label>
                                <select name="productos[0][id]" class="form-select" required>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id_producto }}">
                                            {{ $producto->nombre }} ({{ $producto->unidad_medida }})
                                        </option>
                                    @endforeach
                                </select>

                                <label class="form-label mt-3 fw-semibold">Cantidad:</label>
                                <input type="number" name="productos[0][cantidad]" class="form-control" min="1" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" onclick="agregarProducto()" class="btn btn-warning text-white">
                                <i class="bi bi-plus-circle"></i> Agregar otro producto
                            </button>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Registrar Pedido
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
            <div class="producto-group mb-4">
                <label class="form-label fw-semibold">Producto:</label>
                <select name="productos[${index}][id]" class="form-select" required>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id_producto }}">{{ $producto->nombre }} ({{ $producto->unidad_medida }})</option>
                    @endforeach
                </select>

                <label class="form-label mt-3 fw-semibold">Cantidad:</label>
                <input type="number" name="productos[${index}][cantidad]" class="form-control" min="1" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
        index++;
    }
</script>
@endsection

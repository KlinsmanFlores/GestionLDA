<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .flex { display: flex; justify-content: space-between; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #333; padding: 5px; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/logo2.png') }}" style="height:60px;" alt="Logo">
        <h2>Factura N° {{ $factura->serie }}-{{ str_pad($factura->correlativo, 6, '0', STR_PAD_LEFT) }}</h2>
        <p>{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</p>
    </div>

    <div class="flex" style="margin-bottom:20px;">
        <div>
            <h4>De:</h4>
            <p>Gestión LDA</p>
            <p>Av. Arequipa 304</p>
            <p>gestionlda@example.com</p>
        </div>
        <div>
            <h4>Para:</h4>
            <p><strong>RUC:</strong> {{ $factura->ruc }}</p>
            <p><strong>Razón Social:</strong> {{ $factura->razon_social }}</p>
            <p><strong>Dirección:</strong> {{ $factura->direccion }}</p>
            <p><strong>Tipo Cliente:</strong> {{ ucfirst($factura->cliente->tipo_cliente) }}</p>
            @if($factura->cliente->referencia)
                <p><strong>Referencia:</strong> {{ $factura->cliente->referencia }}</p>
            @endif
            <p><strong>Medio Pago:</strong> {{ ucfirst($factura->medio_pago) }}</p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>PU</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->detalles as $d)
            <tr>
                <td>{{ $d->producto_id }}</td>
                <td>{{ $d->producto->nombre }}</td>
                <td class="text-right">{{ $d->cantidad }}</td>
                <td class="text-right">S/ {{ number_format($d->producto->pvp, 2) }}</td>
                <td class="text-right">
                    S/ {{ number_format($d->cantidad * $d->producto->pvp, 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Subtotal:</th>
                <th class="text-right">S/ {{ number_format($factura->subtotal, 2) }}</th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">IGV (18%):</th>
                <th class="text-right">S/ {{ number_format($factura->igv, 2) }}</th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Total:</th>
                <th class="text-right"><strong>S/ {{ number_format($factura->total, 2) }}</strong></th>
            </tr>
        </tfoot>
    </table>

    <p style="text-align:center; font-size:10px;">¡Gracias por su compra!</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Guía #{{ $guia->id }}</title>
    <style>
        /* estilos inline para PDF */
        body { font-family: sans-serif; font-size: 12px; }
        h1 { font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 1em; }
        th, td { border: 1px solid #333; padding: 4px; text-align: left; }
    </style>
    </head>
    <body>
    <h1>Guía de Remisión #{{ $guia->id }}</h1>
    <p><strong>Fecha envío:</strong> {{ \Carbon\Carbon::parse($guia->fecha_envio)->format('d-m-Y H:i') }}</p>
    <p><strong>Pedido:</strong> #{{ $guia->pedido_id }}</p>
    <p><strong>Cliente:</strong> {{ $guia->pedido->cliente->nombre }}</p>
    <p><strong>Vehículo:</strong> {{ $guia->flota->marca }} ({{ $guia->flota->placa }})</p>
    <p>
    <strong>Conductor:</strong>
    {{ optional(
        optional($guia->flota->chofer)->usuario
        )->nombre 
        ?? 'Sin conductor asignado' 
    }}
    </p>
    <table>
        <thead>
        <tr>
            <th>Producto</th><th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        @foreach($guia->pedido->detalles as $det)
            <tr>
            <td>{{ $det->producto->nombre }}</td>
            <td>{{ $det->cantidad }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p><strong>Ruta:</strong> {{ $guia->punto_partida }} → {{ $guia->punto_llegada }}</p>
</body>
</html>

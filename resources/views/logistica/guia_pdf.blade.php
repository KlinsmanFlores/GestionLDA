<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guía #{{ $guia->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
            margin: 40px;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .logo {
            width: 120px;
            height: auto;
        }
        .empresa-info {
            text-align: right;
        }
        .empresa-info h1 {
            font-size: 18px;
            margin: 0;
        }
        .empresa-info p {
            font-size: 12px;
            margin: 0;
        }
        .section {
            margin-top: 20px;
        }
        .section p {
            margin: 4px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            border: 1px solid #555;
            padding: 6px;
            font-size: 11px;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer {
            margin-top: 30px;
            font-style: italic;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

<header>
    <img src="{{ public_path('img/logo2.png') }}" alt="Logo Empresa" class="logo">
    <div class="empresa-info">
        <h1>Guía de Remisión #{{ $guia->id }}</h1>
        <p>Empresa Gestion de Control LDA</p>
        <p>RUC: 20481234567</p>
    </div>
</header>

<div class="section">
    <p><strong>Fecha de envío:</strong> {{ \Carbon\Carbon::parse($guia->fecha_envio)->format('d-m-Y H:i') }}</p>
    <p><strong>Pedido:</strong> #{{ $guia->pedido_id }}</p>
    <p><strong>Cliente:</strong> {{ optional(optional($guia->pedido->cliente)->usuario)->nombre ?? '—' }}</p>
    <p><strong>Vehículo:</strong> {{ $guia->flota->marca }} ({{ $guia->flota->placa }})</p>
    <p><strong>Conductor:</strong> {{ optional(optional($guia->flota->chofer)->usuario)->nombre ?? 'Sin conductor asignado' }}</p>
</div>

<div class="section">
    <h3>Productos Incluidos</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guia->pedido->detalles as $det)
                <tr>
                    <td>{{ $det->producto->nombre }}</td>
                    <td>{{ $det->cantidad }} unidades</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="section">
    <p><strong>Ruta:</strong> {{ $guia->punto_partida }} → {{ $guia->punto_llegada }}</p>
</div>

<div class="footer">
    Esta guía ha sido generada automáticamente por el sistema de gestión logística.
</div>

</body>
</html>

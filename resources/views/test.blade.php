<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Camión</title>
</head>
<body>
    <h2>Formulario de prueba Asignar Camión</h2>

    <form action="{{ route('logistica.asignar.camion', 4) }}" method="POST">
        @csrf
        <button type="submit">Asignar camión ID 4</button>
    </form>
</body>
</html>

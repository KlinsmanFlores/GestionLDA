<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  {{-- Aquí he eliminado todas las llamadas a Tailwind, Bootstrap y fuentes --}}
  {{-- Si necesitas estilos o scripts específicos, inclúyelos en la propia vista --}}
</head>
<body>
  {{-- Este layout ya no aplica ningún wrapper ni estilos de Breeze --}}
  {{-- Tu vista (<x-auth-layout>…</x-auth-layout>) debe encargarse de todo el diseño --}}
  {{ $slot }}
</body>
</html>

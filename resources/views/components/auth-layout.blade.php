<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>GestiónLDA</title>

  {{-- 1) CDN de Tailwind (para que tus clases utility funcionen) --}}
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- 2) (Opcional) Si quieres usar tu CSS compilado por Vite --}}
  {{-- @vite('resources/css/app.css') --}}
</head>
<body class="min-h-screen flex items-center justify-center bg-[#1e293b] p-4">
  {{ $slot }}
</body>
</html>

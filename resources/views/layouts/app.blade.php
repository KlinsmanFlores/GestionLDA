<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Laravel')</title>

    {{-- Bootstrap desde CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome (iconos de redes sociales) -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet"
    />


    {{-- Si sigues usando Vite y Tailwind también --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased bg-gray-100 d-flex flex-column min-vh-100">
    {{-- NAVBAR mejorado con Bootstrap 5 --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow py-3">
    <div class="container">
        {{-- Logo y título --}}
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('img/logo2.png') }}" alt="Logo LDA" width="80" height="80" class="rounded shadow-sm me-2">
            <span class="fw-bold fs-5">LDA Gestión</span>
        </a>

        {{-- Opciones de navegación (puedes personalizar) --}}
        <div class="d-none d-lg-flex align-items-center gap-4">
            <a href="http://localhost/inicio" class="nav-link text-white">Inicio</a>
            <a href="#" class="nav-link text-white">Productos</a>
            <a href="http://localhost/admin/login" class="btn btn-outline-light btn-sm px-3">Cerrar Sesión</a>
        </div>
    </div>
</nav>



    
    
    <div class="flex-grow-1">
        {{-- Header opcional --}}
        
        @yield('header')

        {{-- Contenido principal --}}
        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    
    <!-- Footer -->
    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331; font-family: 'Segoe UI', sans-serif;">
    <!-- Sección: Redes sociales -->
    <section class="d-flex justify-content-between align-items-center p-4" style="background-color: #6351ce">
        <div class="me-5">
            <span class="fw-semibold">Síguenos en redes sociales:</span>
        </div>

        <div>
            <a href="https://www.facebook.com/marcoantonio.vasquezpauca" class="text-white me-4"><i class="fab fa-facebook-f fa-lg"></i></a>
            <a href="http://www.tiktok.com/@marcoavasquezp" class="text-white me-4"><i class="fab fa-twitter fa-lg"></i></a>
            <a href="http://www.tiktok.com/@marcoavasquezp" class="text-white me-4"><i class="fab fa-google fa-lg"></i></a>
            <a href="https://www.instagram.com/marcoavasquezp8773/" class="text-white me-4"><i class="fab fa-instagram fa-lg"></i></a>
            <a href=" https://www.linkedin.com/in/marco-antonio-vasquez-pauca-104113193/" class="text-white me-4"><i class="fab fa-linkedin fa-lg"></i></a>
            <a href="https://github.com/KlinsmanFlores/GestionLDA" class="text-white me-4"><i class="fab fa-github fa-lg"></i></a>
        </div>
    </section>

    <!-- Sección de enlaces -->
    <section class="pt-5">
        <div class="container text-center text-md-start">
            <div class="row mt-3">
                <!-- Columna 1 -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">🚚 GESTIÓN LDA</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px;">
                    <p>Optimización de entregas y control logístico para un servicio eficiente y rápido.</p>
                </div>

                <!-- Columna 2 -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Servicios</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px;">
                    <p><a href="http://localhost/admin/login" class="text-white text-decoration-none">Ventas</a></p>
                    <p><a href="http://localhost/admin/login" class="text-white text-decoration-none">Logistica</a></p>
                    <p><a href="http://localhost/admin/login" class="text-white text-decoration-none">transporte</a></p>
                    <p><a href="http://localhost/admin/login" class="text-white text-decoration-none">Reportes</a></p>
                </div>

                <!-- Columna 3 -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Enlaces útiles</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px;">
                    <p><a href="#" class="text-white text-decoration-none">Tu cuenta</a></p>
                    <p><a href="#" class="text-white text-decoration-none">Soporte técnico</a></p>
                    <p><a href="#" class="text-white text-decoration-none">Políticas</a></p>
                    <p><a href="#" class="text-white text-decoration-none">Ayuda</a></p>
                </div>

                <!-- Columna 4 -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold">📬 Contacto</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px;">
                    <p><i class="fas fa-home me-2"></i> Av. Arequipa 304, Arequipa</p>
                    <p><i class="fas fa-envelope me-2"></i> gestionlda@example.com</p>
                    <p><i class="fas fa-phone me-2"></i> +51 987 654 321</p>
                    <p><i class="fas fa-print me-2"></i> +51 945 123 456</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0,0,0,0.2)">
        © {{ date('Y') }} <strong>Gestión LDA</strong> — Todos los derechos reservados.
    </div>
</footer>

    <!-- Footer -->
    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
            <div id="toastSuccess" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ✅ {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                </div>
            </div>
        </div>

        <script>
            const toastEl = document.getElementById('toastSuccess');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        </script>
    @endif

    {{-- Bootstrap JS (opcional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    

</body>
</html>

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
    {{-- NAVBAR Bootstrap: Barra que ocupa todo el ancho --}}
    
        <nav class="navbar bg-dark navbar-dark py-3">
        <div class="container d-flex justify-content-center" style="font-family: 'Roboto', sans-serif;">
            <!-- LOGO y nombre de empresa -->
            <a class="navbar-brand " href="#">
                <img src="{{ asset('img/logo2.png') }}" alt="Logo LDA"
                    width="150" height="150"
                    class="d-inline-block rounded shadow"
                    style="object-fit: contain;">               
            Management Control System</a>
            
    
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
    <footer
            class="text-center text-lg-start text-white"
            style="background-color: #1c2331"
            >
        <!-- Section: Social media -->
        <section
                class="d-flex justify-content-between p-4"
                style="background-color: #6351ce"
                >
        <!-- Left -->
        <div class="me-5">
            <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="text-white me-4">
            <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="text-white me-4">
            <i class="fab fa-google"></i>
            </a>
            <a href="" class="text-white me-4">
            <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="text-white me-4">
            <i class="fab fa-linkedin"></i>
            </a>
            <a href="" class="text-white me-4">
            <i class="fab fa-github"></i>
            </a>
        </div>
        <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-uppercase fw-bold">GESTION LDA</h6>
                <hr
                    class="mb-4 mt-0 d-inline-block mx-auto"
                    style="width: 60px; background-color: #7c4dff; height: 2px"
                    />
                <p>
                Optimización de entregas y control logístico para un servicio eficiente.
                </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold">Products</h6>
                <hr
                    class="mb-4 mt-0 d-inline-block mx-auto"
                    style="width: 60px; background-color: #7c4dff; height: 2px"
                    />
                <p>
                <a href="#!" class="text-white">MDBootstrap</a>
                </p>
                <p>
                <a href="#!" class="text-white">MDWordPress</a>
                </p>
                <p>
                <a href="#!" class="text-white">BrandFlow</a>
                </p>
                <p>
                <a href="#!" class="text-white">Bootstrap Angular</a>
                </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold">Useful links</h6>
                <hr
                    class="mb-4 mt-0 d-inline-block mx-auto"
                    style="width: 60px; background-color: #7c4dff; height: 2px"
                    />
                <p>
                <a href="#!" class="text-white">Your Account</a>
                </p>
                <p>
                <a href="#!" class="text-white">Become an Affiliate</a>
                </p>
                <p>
                <a href="#!" class="text-white">Shipping Rates</a>
                </p>
                <p>
                <a href="#!" class="text-white">Help</a>
                </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold">ContactO</h6>
                <hr
                    class="mb-4 mt-0 d-inline-block mx-auto"
                    style="width: 60px; background-color: #7c4dff; height: 2px"
                    />
                <p><i class="fas fa-home mr-3"></i> Av Arequipa, Urb los Divinos 304</p>
                <p><i class="fas fa-envelope mr-3"></i> GestionLDA@example.com</p>
                <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
            </div>
            <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div
            class="text-center p-3"
            style="background-color: rgba(0, 0, 0, 0.2)"
            >
        © 2025 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/"
            >Sistema de Envíos y Gestión. Todos los derechos reservados</a
            >
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    {{-- Bootstrap JS (opcional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

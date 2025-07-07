<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo', 'Panel Cliente')</title>

    {{-- Bootstrap CSS --}}
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    >

    {{-- Font Awesome --}}
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      rel="stylesheet"
    />

    {{-- Google Fonts: Roboto --}}
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
      rel="stylesheet"
    >

    {{-- Tailwind / app.css + app.js via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js (solo una vez) --}}
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
</head>
<body class="bg-light text-info-emphasis">
    <nav class="navbar bg-dark navbar-dark py-3">
        <div class="container d-flex justify-content-center" style="font-family: 'Roboto', sans-serif;">
            <a class="navbar-brand" href="#">
                <img
                  src="{{ asset('img/logo2.png') }}"
                  alt="Logo LDA"
                  width="150" height="150"
                  class="d-inline-block rounded shadow"
                  style="object-fit: contain;"
                >
                Management Control System
            </a>
        </div>

        @auth
        <form
            action="{{ route('cliente.logout') }}"
            method="POST"
            class="mb-0 ms-auto"
            >
                @csrf
                <button type="submit" class="btn btn-outline-light">
                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </button>
            </form>
            @endauth
        </nav>

        <div class="flex-grow-1">
        <main class="py-6 max-w-5xl mx-auto px-4">
            @yield('contenido')
        </main>
    </div>

    <footer
                class="text-center text-lg-start text-white"
                style="background-color: #1c2331"
                >
            <!-- Section: Social media -->
            <section
                    class="d-flex justify-content-between p-4"
                    style="background-color:darkslategrey"
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

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
            <div id="toastSuccess" class="toast text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
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
                const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
                toast.show();
            }
        </script>
    @endif

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Catálogo de Productos – LDA</title>

  <!-- Tailwind CSS (CDN) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous"
  />

  <!-- Bootstrap Icons -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    rel="stylesheet"
  />

  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

  <!-- Navbar (siempre expandido) -->
  <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img
          src="{{ asset('img/logo2.png') }}"
          alt="LDA"
          width="150"
          height="150"
          class="d-inline-block rounded shadow"
          style="object-fit: contain;"
        >
      </a>

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a href="{{ route('cliente.register.form') }}" class="nav-link">Registrarme</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('cliente.login.form') }}" class="nav-link">Iniciar sesión</a>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="categoriesDropdown"
            role="button"
            data-bs-toggle="dropdown"
          >
            Categorías
          </a>
          <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
            <li><a class="dropdown-item" href="#">Electro</a></li>
            <li><a class="dropdown-item" href="#">Hogar</a></li>
            <li><a class="dropdown-item" href="#">Alimentos</a></li>
          </ul>
        </li>
      </ul>

      <form class="d-flex me-3">
        <input
          class="form-control"
          type="search"
          placeholder="Buscar en LDA"
          aria-label="Buscar"
        >
      </form>

      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item"><span class="nav-link">Hola, Klinsman ▾</span></li>
        <li class="nav-item">
          <a class="nav-link position-relative" href="#">
            <i class="bi bi-cart"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              1
            </span>
          </a>
        </li>
      </ul>
    </div>
  </nav>

<!-- Hero Carousel grande (ajustado para ver la imagen completa) -->
<div x-data="carousel()"
     class="relative w-full h-64 overflow-hidden mt-4 flex items-center justify-center bg-white">
  <template x-for="(img, i) in images" :key="i">
    <img
      :src="img"
      x-show="current === i"
      class="max-h-full max-w-full object-contain transition-opacity duration-1000"
      alt="Slide image"
    >
  </template>

  <!-- Controles prev/next -->
  <button @click="prev()"
          class="absolute left-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
    ‹
  </button>
  <button @click="next()"
          class="absolute right-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
    ›
  </button>

  <!-- Indicadores -->
  <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
    <template x-for="(_, i) in images" :key="i">
      <span @click="current = i"
            :class="current === i ? 'bg-white' : 'bg-gray-400'"
            class="w-2 h-2 rounded-full cursor-pointer">
      </span>
    </template>
  </div>
</div>


  <!-- Alpine.js initialization -->
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('carousel', () => ({
        current: 0,
        images: [
          '{{ asset("img/leche.png") }}',
          '{{ asset("img/aceite.png") }}',
          '{{ asset("img/agua.png") }}',
          '{{ asset("img/fideos.png") }}',
          '{{ asset("img/arroz.png") }}',
          '{{ asset("img/atun.png") }}',
          '{{ asset("img/azucar.png") }}',
          '{{ asset("img/chocolate.png") }}',
          '{{ asset("img/harina.png") }}',
          '{{ asset("img/sal.png") }}'
        ],
        init() {
          setInterval(() => this.next(), 5000);
        },
        next() {
          this.current = (this.current + 1) % this.images.length;
        },
        prev() {
          this.current = (this.current - 1 + this.images.length) % this.images.length;
        }
      }));

      Alpine.data('carouselSection', items => ({
        items,
        scrollNext(el) {
          el.querySelector('.flex').scrollBy({ left: 200, behavior: 'smooth' });
        },
        scrollPrev(el) {
          el.querySelector('.flex').scrollBy({ left: -200, behavior: 'smooth' });
        },
        getName(src) {
          const file = src.split('/').pop();
          return {
            'leche.png': 'Leche Gloria 1L',
            'aceite.png': 'Aceite Primor 1L',
            'agua.png': 'Agua Mineral 500ml',
            'fideos.png': 'Fideos 500g',
            'arroz.png': 'Arroz Zafriño 1kg',
            'atun.png': 'Atún Van Camps 170g',
            'azucar.png': 'Azúcar Doble 1kg',
            'chocolate.png': 'Chocolate Tableta 100g',
            'harina.png': 'Harina Selecta 1kg',
            'sal.png': 'Sal Marina 1kg'
          }[file] || '';
        },
        getDesc(src) {
          const file = src.split('/').pop();
          return {
            'leche.png': 'Leche entera pasteurizada',
            'aceite.png': 'Aceite de girasol refinado',
            'agua.png': 'Agua natural sin gas',
            'fideos.png': 'Fideos de trigo clásico',
            'arroz.png': 'Arroz blanco de grano largo',
            'atun.png': 'Atún en agua',
            'azucar.png': 'Azúcar granulada',
            'chocolate.png': 'Chocolate amargo',
            'harina.png': 'Harina de trigo',
            'sal.png': 'Sal yodada'
          }[file] || '';
        },
        getPrice(src) {
          const file = src.split('/').pop();
          return {
            'leche.png': 'S/4.49',
            'aceite.png': 'S/7.99',
            'agua.png': 'S/1.20',
            'fideos.png': 'S/3.50',
            'arroz.png': 'S/6.90',
            'atun.png': 'S/6.75',
            'azucar.png': 'S/5.50',
            'chocolate.png': 'S/8.99',
            'harina.png': 'S/3.25',
            'sal.png': 'S/2.50'
          }[file] || '';
        }
      }));
    });
  </script>

  <!-- Sección: Lo mejor en electro -->
  <section class="mt-5 container">
    <h2 class="text-center text-2xl fw-bold mb-4 d-flex justify-content-center align-items-center">
      <span>Lo mejor en</span>
      <img src="{{ asset('img/envasados.png') }}" alt="Electro" class="mx-2" style="height:24px;">
      <span>Alimentos envasados o enlatados</span>
    </h2>
    <div x-data="carouselSection([
      '{{ asset("img/leche.png") }}',
      '{{ asset("img/aceite.png") }}',
      '{{ asset("img/agua.png") }}',
      '{{ asset("img/fideos.png") }}',
      '{{ asset("img/arroz.png") }}',
      '{{ asset("img/azucar.png") }}',
      '{{ asset("img/chocolate.png") }}',
      '{{ asset("img/harina.png") }}',
      '{{ asset("img/sal.png") }}',
      '{{ asset("img/atun.png") }}'
    ])" class="relative">
      <div class="flex gap-3 overflow-auto pb-2" style="scroll-snap-type: x mandatory;">
        <template x-for="img in items" :key="img">
          <div class="bg-white rounded shadow-sm flex-shrink-0" style="width:12rem; scroll-snap-align:start;">
            <img :src="img" class="w-full" style="height:8rem; object-fit:cover;">
            <div class="p-2">
              <h3 class="fs-6 fw-semibold" x-text="getName(img)"></h3>
              <p class="text-muted fs-7" x-text="getDesc(img)"></p>
              <p class="text-danger fw-bold" x-text="getPrice(img)"></p>
            </div>
          </div>
        </template>
      </div>
      <button @click="scrollPrev($el)" class="absolute top-1/2 start-0 translate-middle-y btn btn-light rounded-full p-1 shadow-sm">‹</button>
      <button @click="scrollNext($el)" class="absolute top-1/2 end-0 translate-middle-y btn btn-light rounded-full p-1 shadow-sm">›</button>
    </div>
  </section>

  <!-- Sección: Lo mejor en hogar -->
  <section class="mt-5 container">
    <h2 class="text-center text-2xl fw-bold mb-4 d-flex justify-content-center align-items-center">
      <span>Lo mejor en</span>
      <img src="{{ asset('img/desodorante.png') }}" alt="" class="mx-2" style="height:24px;">
      <span>Higiene</span>
    </h2>
    <div x-data="carouselSection([
      '{{ asset("img/detergente.png") }}',
      '{{ asset("img/suave.png") }}',
      '{{ asset("img/sedal.png") }}',
      '{{ asset("img/hs.png") }}'
    ])" class="relative">
      <div class="flex gap-3 overflow-auto pb-2" style="scroll-snap-type: x mandatory;">
        <template x-for="img in items" :key="img">
          <div class="bg-white rounded shadow-sm flex-shrink-0" style="width:12rem; scroll-snap-align:start;">
            <img :src="img" class="w-full" style="height:8rem; object-fit:cover;">
            <div class="p-2">
              <h3 class="fs-6 fw-semibold" x-text="getName(img)"></h3>
              <p class="text-muted fs-7" x-text="getDesc(img)"></p>
              <p class="text-danger fw-bold" x-text="getPrice(img)"></p>
            </div>
          </div>
        </template>
      </div>
      <button @click="scrollPrev($el)" class="absolute top-1/2 start-0 translate-middle-y btn btn-light rounded-full p-1 shadow-sm">‹</button>
      <button @click="scrollNext($el)" class="absolute top-1/2 end-0 translate-middle-y btn btn-light rounded-full p-1 shadow-sm">›</button>
    </div>
  </section>

  <!-- Sección: Lo mejor en alimentos (placeholder) -->
  <section class="mt-5 container mb-5">
    <h2 class="text-center text-2xl fw-bold mb-4 d-flex justify-content-center align-items-center">
      <span>Lo mejor en</span>
      <img src="{{ asset('img/desodorante.png') }}" alt="Alimentos" class="mx-2" style="height:24px;">
      <span>limpieza</span>
    </h2>
    <div x-data="carouselSection([
      // Añade aquí tus imágenes de alimentos:
      // '{{ asset("img/sopa.png") }}', '{{ asset("img/jugo.png") }}', ...
    ])" class="relative">
      <div class="flex gap-3 overflow-auto pb-2" style="scroll-snap-type: x mandatory;">
        <template x-for="img in items" :key="img">
          <div class="bg-white rounded shadow-sm flex-shrink-0" style="width:12rem; scroll-snap-align:start;">
            <img :src="img" class="w-full" style="height:8rem; object-fit:cover;">
            <div class="p-2">
              <h3 class="fs-6 fw-semibold" x-text="getName(img)"></h3>
              <p class="text-muted fs-7" x-text="getDesc(img)"></p>
              <p class="text-danger fw-bold" x-text="getPrice(img)"></p>
            </div>
          </div>
        </template>
      </div>
      <button @click="scrollPrev($el)" class="absolute top-1/2 start-0 translate-middle-y btn btn-light rounded-full p-1 shadow-sm">‹</button>
      <button @click="scrollNext($el)" class="absolute top-1/2 end-0 translate-middle-y btn btn-light rounded-full p-1 shadow-sm">›</button>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white py-3 text-center text-muted">
    © 2025 LDA. Todos los derechos reservados.
  </footer>

  <!-- Bootstrap JS + Popper -->
  <script
    defer
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"
  ></script>
</body>
</html>

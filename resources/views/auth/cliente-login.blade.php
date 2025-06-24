<x-guest-layout>
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center p-0 login-bg">
        <div class="card p-4 shadow-lg rounded-4" style="width: 100%; max-width: 400px; background-color: rgba(255, 255, 255, 0.95); border: none;">
            
            <h2 class="text-center text-dark fw-bold mb-0">WELCOME !</h2>
            <p class="text-center text-muted mb-4">Log in to continue</p>

            <form method="POST" action="{{ route('cliente.login') }}">
                @csrf

                <div class="mb-3 text-center">
                    <h5 class="text-primary fw-semibold">Inicio Sesion</h5>
                </div>

                <div class="mb-3">
                    <input type="email" name="correo" class="form-control rounded-pill text-center" placeholder="correo" required autofocus>
                </div>

                <div class="mb-3">
                    <input type="password" name="contrasena" class="form-control rounded-pill text-center" placeholder="password" required>
                </div>

                <div class="mb-3 text-end">
                    <a href="#" class="text-muted" style="font-size: 0.9rem;">Forgot your password?</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-gradient rounded-pill text-black fw-bold">Log in</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <span class="text-muted">Don’t have any account?</span>
                <a href="#" class="text-primary fw-semibold">Sign Up</a>
            </div>
        </div>
    </div>
</x-guest-layout>

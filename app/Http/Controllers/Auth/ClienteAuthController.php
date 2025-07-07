<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class ClienteAuthController extends Controller
{
    // Mostrar vista de registro
    public function showRegisterForm()
    {
        return view('auth.cliente-register');
    }

    // Procesar registro del clinete y lo redirije al web de pedir lso productos
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:usuarios',
            'correo' => 'required|string|email|max:255|unique:usuarios',
            'telefono' => 'nullable|string|max:50',
            'contrasena' => 'required|string|confirmed|min:6',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contrasena' => Hash::make($request->contrasena),
            'id_rol' => 2, // Cliente
        ]);

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect()->route('cliente.pedido.crear');

    }

    // Mostrar vista de login
    public function showLoginForm()
    {
        return view('auth.cliente-login');
    }

    // Procesar login  inicia sesion y lo manda a la pagina de los pedidos de los productos
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required|string',
        ]);

        $usuario = Usuario::where('correo', $request->correo)->first();

        if (!$usuario || !Hash::check($request->contrasena, $usuario->contrasena)) {
            return back()->withErrors(['correo' => 'Credenciales incorrectas']);
        }

        if ($usuario->id_rol != 2) {
            return back()->withErrors(['correo' => 'Este usuario no es cliente.']);
        }

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect()->route('cliente.pedido.crear');

    }
    /**
     * Cierra sesión del cliente y limpia la sesión.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/cliente/login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'dni' => ['required', 'string', 'max:20', 'unique:usuarios,dni'],
            'correo' => ['required', 'string', 'email', 'max:150', 'unique:usuarios,correo'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'contrasena' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contrasena' => Hash::make($request->contrasena),
            'id_rol' => 3, // Asignar rol por defecto, por ejemplo: 2 = cliente
        ]);

        event(new Registered($usuario));

        Auth::login($usuario);

        //return redirect()->route('dashboard');
        $user = Auth::user();

        switch ($user->id_rol) {
            case 1:
                return redirect('/admin/inicio');
            case 2:
                return redirect('/cliente/inicio');
            case 3:
                return redirect('/chofer/inicio');
            case 4:
                return redirect('/vendedor/inicio');
            case 5:
                return redirect('/logistica/inicio');
            default:
                return redirect('/dashboard');
        }

    }
}

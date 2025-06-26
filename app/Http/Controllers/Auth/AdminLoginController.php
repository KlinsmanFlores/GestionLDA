<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

use function PHPUnit\Framework\returnSelf;

class AdminLoginController extends Controller
{
    /**
     * Muestra la vista del formulario de login para administradores.
     */
    public function create()
    {
        return view('auth.admin-login');
    }



    /**
     * Valida las credenciales del administrador (correo, contraseña y rol),
     * autentica al usuario y lo redirige según su rol.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Valida que los campos esten presentes y tengan el fomrato correcto
        $request->validate([
            'correo' => ['required', 'email'],
            'contrasena' => ['required'],
            'rol_seleccionado' => ['required'],
        ]);

        //busca al usuario por correo
        $usuario = Usuario::where('correo', $request->correo)->first();

        //verifica que el rol seleccionado coincida con el rol de usuario
        if (!$usuario || !Hash::check($request->contrasena, $usuario->contrasena)) {
            return back()->withErrors([
                'correo' => 'Credenciales incorrectas.',
            ]);
        }

        if ($usuario->id_rol != $request->rol_seleccionado) {
            return back()->withErrors([
                'rol_seleccionado' => 'El rol seleccionado no coincide con el del usuario.',
            ]);
        }

        //autentifica al usuario y regenera la sesion
        Auth::login($usuario);
        $request->session()->regenerate();

        // Redirección por rol
        switch ($usuario->id_rol) {
            case 1:
                return redirect()->route('admin.usuarios.roles');  // vamos a cambiar para probar create  ,, choserol
            case 3:
                return redirect()->route('chofer.guias');
            case 4:
                return redirect('/vendedor/pedidos');
            case 5:
                return redirect('/logistica/pedidos');
            default:
                return redirect('/dashboard');
                //return ("sigue intentando");
        }
    }
}

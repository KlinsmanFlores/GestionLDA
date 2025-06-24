<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioInternoController extends Controller
{
    public function create()
    {
        // Asegurar que solo el admin acceda
        if (Auth::user()->id_rol != 1) {
            abort(403, 'Acceso no autorizado.');
        }

        return view('admin.usuarios.crear');
    }




    //--------------
    public function store(Request $request)
    {
        if (Auth::user()->id_rol != 1) {
            abort(403, 'Acceso no autorizado.');
        }

        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'dni' => 'required|string|max:20|unique:usuarios,dni',
            'correo' => 'required|email|unique:usuarios,correo',
            'telefono' => 'nullable|string|max:50',
            'contrasena' => 'required|string|min:6',
            'id_rol' => 'required|in:3,4,5' // Solo transportista, vendedor, logística
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contrasena' => Hash::make($request->contrasena),
            'id_rol' => $request->id_rol
        ]);

        return redirect()->route('admin.usuarios.create')->with('success', 'Trabajador registrado correctamente.');
    }
}

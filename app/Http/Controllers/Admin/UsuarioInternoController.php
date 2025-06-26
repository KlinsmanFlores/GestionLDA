<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioInternoController extends Controller
{
    /**
     * Mostrar la vista para elegir rol.
     */
    public function chooseRole()
    {
        return view('admin.usuarios.choose-role');
    }

    /**
     * Mostrar formulario de creación de usuario según rol.
     *
     * @param  int  $id_rol
     */
    public function createByRole($id_rol)
    {
        return view('admin.usuarios.crear', compact('id_rol'));
    }

    /**
     * Almacenar un nuevo usuario y redirigir
     * al formulario de Chofer (rol 3).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_rol
     */
    public function store(Request $request, $id_rol)
    {
        // Validación de datos de usuario
        $data = $request->validate([
            'nombre'     => 'required|string|max:100',
            'apellidos'  => 'required|string|max:100',
            'dni'        => 'required|string|max:20|unique:usuarios,dni',
            'correo'     => 'required|email|unique:usuarios,correo',
            'telefono'   => 'nullable|string|max:50',
            'contrasena' => 'required|string|min:6',
        ]);

        // Crear usuario
        $user = Usuario::create([
            'nombre'     => $data['nombre'],
            'apellidos'  => $data['apellidos'],
            'dni'        => $data['dni'],
            'correo'     => $data['correo'],
            'telefono'   => $data['telefono'] ?? null,
            'contrasena' => bcrypt($data['contrasena']),
            'id_rol'     => $id_rol,
        ]);

        // Redirigir según rol seleccionado
        switch ($id_rol) {
            case 3:
                // Chofer
                return redirect()->route('admin.choferes.create', ['usuario' => $user->id_usuario]);

            case 4:
                // Vendedor
                return redirect()->route('admin.vendedores.create', ['usuario' => $user->id_usuario]); // modificado

            case 5:
                // Logística
                return redirect()->route('admin.logisticas.create', ['usuario' => $user->id_usuario]); // modificado

            default:
                abort(400, 'Rol no soportado para este flujo.');
        }
    }
}

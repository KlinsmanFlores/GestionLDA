<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flota;
use App\Models\Chofer;

class FlotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Flota::with('chofer')->paginate(10);
        return view('admin.flota.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.flota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            
            'marca'                => 'required|string|max:255',
            'placa'                => 'required|string|max:20|unique:flota,placa',
            'peso_neto'            => 'required|numeric|min:0',
            'peso_bruto_vehicular' => 'required|numeric|min:0',
            'capacidad_carga'      => 'required|numeric|min:0',
            'alto_contenedor'      => 'required|numeric|min:0',
            'ancho_contenedor'     => 'required|numeric|min:0',
            'largo_contenedor'     => 'required|numeric|min:0',
        ]);

        Flota::create($data);

        return redirect()
            ->route('admin.flota.index')
            ->with('success', 'Vehículo registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flota $flota)
    {
        //
        
        return view('admin.flota.edit', compact('flota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flota $flota)
    {
        //
        $rules = [
            'marca' => 'required|string|max:255',
            'placa' => 'required|string|max:20|unique:flota,placa,'.$flota->id_flota.',id_flota',
        ];

        foreach ([
            'peso_neto',
            'peso_bruto_vehicular',
            'capacidad_carga',
            'alto_contenedor',
            'ancho_contenedor',
            'largo_contenedor'
        ] as $field) {
            if ($request->has($field)) {
                $rules[$field] = 'numeric|min:0';
            }
        }

        $data = $request->validate($rules);

        $flota->update($data);

        return redirect()
            ->route('admin.flota.index')
            ->with('success', 'Vehículo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flota $flota)
    {
        //
        $flota->delete();
        return back()->with('success', 'Vehículo eliminado.');
    }
}

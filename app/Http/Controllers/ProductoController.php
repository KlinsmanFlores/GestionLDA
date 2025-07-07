<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('logistica.producto.index', compact('productos'));
    }

    public function create()
    {
        return view('logistica.producto.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'peso' => 'required|numeric',
            'unidad_medida' => 'required|string|max:50',
            'alto' => 'required|numeric',
            'ancho' => 'required|numeric',
            'largo' => 'required|numeric',
            'pvp' => 'required|numeric',
            'costo_con_igv' => 'required|numeric',
            'stock_mano' => 'required|integer',
            'stock_transito' => 'required|integer',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto)
    {
        return view('logistica.producto.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('logistica.producto.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'peso' => 'required|numeric',
            'unidad_medida' => 'required|string|max:50',
            'alto' => 'required|numeric',
            'ancho' => 'required|numeric',
            'largo' => 'required|numeric',
            'pvp' => 'required|numeric',
            'costo_con_igv' => 'required|numeric',
            'stock_mano' => 'required|integer',
            'stock_transito' => 'required|integer',
        ]);

        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // listar todos
    public function index() {
        $productos = Producto::all();
        return response()->json($productos);
    }

    // traer por ID
    public function show($id) {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['mensaje' => 'No encontrado'], 404);
        }
        return response()->json($producto);
    }

    // Guardar nuevo producto
    public function store(Request $request) {
        $producto = Producto::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
            'stock'       => $request->stock,
            'categoria'   => $request->categoria,
            'origen'       => $request->origen,
            'imagen_url'  => $request->imagen_url
        ]);
        return response()->json($producto, 201);
    }

    // Actualizar producto
    public function update(Request $request, $id) {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['mensaje' => 'No encontrado'], 404);
        }
        $producto->nombre      = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio      = $request->precio;
        $producto->stock       = $request->stock;
        $producto->categoria   = $request->categoria;
        $producto->origen       = $request->origen;
        $producto->imagen_url  = $request->imagen_url;
        $producto->save();
        return response()->json($producto);
    }

    // eliminar producto
    public function destroy($id) {
        Producto::destroy($id);
        return response()->json(['mensaje' => 'Producto eliminado']);
    }
}
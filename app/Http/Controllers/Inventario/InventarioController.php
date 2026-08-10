<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Models\Inventario\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventarioController extends Controller
{
    // GET /api/inventario  (soporta ?buscar=texto)
    public function index(Request $request)
    {
        $query = Inventario::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('id', 'like', "%{$buscar}%")
                  ->orWhere('nombre', 'like', "%{$buscar}%")
                  ->orWhere('marca', 'like', "%{$buscar}%");
            });
        }

        $inventario = $query->orderBy('id', 'asc')->get();

        return response()->json([
            'ok'   => true,
            'data' => $inventario,
        ]);
    }

    // POST /api/inventario
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'   => 'required|string|max:255',
            'marca'    => 'nullable|string|max:255',
            'cantidad' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok'     => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $item = Inventario::create($request->only(['nombre', 'marca', 'cantidad']));

        return response()->json([
            'ok'   => true,
            'data' => $item,
        ], 201);
    }

    // GET /api/inventario/{id}
    public function show($id)
    {
        $item = Inventario::find($id);

        if (!$item) {
            return response()->json(['ok' => false, 'message' => 'No encontrado'], 404);
        }

        return response()->json(['ok' => true, 'data' => $item]);
    }

    // PUT /api/inventario/{id}
    public function update(Request $request, $id)
    {
        $item = Inventario::find($id);

        if (!$item) {
            return response()->json(['ok' => false, 'message' => 'No encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'   => 'sometimes|required|string|max:255',
            'marca'    => 'nullable|string|max:255',
            'cantidad' => 'sometimes|required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok'     => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $item->update($request->only(['nombre', 'marca', 'cantidad']));

        return response()->json(['ok' => true, 'data' => $item]);
    }

    // DELETE /api/inventario/{id}
    public function destroy($id)
    {
        $item = Inventario::find($id);

        if (!$item) {
            return response()->json(['ok' => false, 'message' => 'No encontrado'], 404);
        }

        $item->delete();

        return response()->json(['ok' => true, 'message' => 'Eliminado correctamente']);
    }
}
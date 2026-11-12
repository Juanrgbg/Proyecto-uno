<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::with('products')->get();

        return response()->json(['data' => $suppliers], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'nombre' => 'required|string|max:100',
        'nit' => 'nullable|string|max:10|unique:suppliers,nit',
        'telefono' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:100',
        ]);

        $suppliers = Supplier::create($validated);
        
        return response()->json(['supplier' => $suppliers], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $suppliers = Supplier::with('products')->findOrFail($id);
            return response()->json(['data' => $suppliers], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Proveedor no encontrado',
                'code' => 404,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
    try {
        $suppliers = Supplier::findOrFail($id);

        $validated = $request->validate([
        'nombre' => 'required|string|max:100',
        'nit' => 'nullable|string|max:10|unique:suppliers,nit',
        'telefono' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:100',
        ]);

        $suppliers->update($validated);
        return response()->json(['data' => $suppliers], 200);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'error' => 'Proveedor no encontrado',
            'code' => 404,
        ], 404);
    }
   
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

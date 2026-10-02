<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();        return response()->json(['data' => $products],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->unit = $request->unit;
        $product->price = $request->price;

        $product->save();
        return response()->json(['product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['data' => $product],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, Request $request)
    {
        $product->code = $request->code;
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->unit = $request->unit;
        $product->price = $request->price;

        $product->save();
        return response()->json(['product' => $product], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['productDelete' => $product, 'Producto eliminado correctamente'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
            'error' => 'Producto no encontrado',
            'code' => 404
            ]);
        }
    }
}

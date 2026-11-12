<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::simplePaginate(5);
        return view('productos.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::all();
        return view('productos.create', ['suppliers' => $supplier]);
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
        $product->supplier = $request->supplier_id;
        $product->image = $request->image;

        $product->save();
        $this->checkLowStock($product);
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $producto)
    {
        $suppliers = Supplier::all();
        return view('productos.edit',compact('producto','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->code = $request->code;
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->unit = $request->unit;
        $product->price = $request->price;
        $product->supplier = $request->supplier;
        $product->image = $request->image;

        $product->save();
        $this->checkLowStock($product);
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }

    public function pdf($id){
        $product = Product::find($id);
        $pdf = PDF::loadView('productos.pdf', compact('product'));
        return $pdf->stream('product'.$product->name.'pdf');
    }
}

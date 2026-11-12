<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Product;
use App\Notifications\StockProduct;
use Barryvdh\DomPDF\facade\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;


class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movements = Movement::simplePaginate(10);
        return view('movimientos.index', ['movements' => $movements]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name','asc')->get();
        return view('movements.create',[
            'products' => $products,
            'movements_type' => [
                Movement::MOVEMENT_TYPE_IN,
                Movement::MOVEMENT_TYPE_DEVOLUTION,
                Movement::MOVEMENT_TYPE_OUT
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $movement = new Movement();
        $movement->type = $request->type;
        $movement->amount = $request->amount;
        $movement->sale_point = $request->sale_point;
        $movement->product_id = $request->producto;
        $movement->save();

        $producto = Product::find($request->producto);
        try{
            switch($movement->type){
                case Movement :: MOVEMENT_TYPE_IN:
                case Movement :: MOVEMENT_TYPE_DEVOLUTION:
                    $producto->increment('amount',$movement->amount);
                    break;
                case Movement :: MOVEMENT_TYPE_OUT:
                    if($producto->amount < $movement->amount){
                        throw new Exception('La cantidad solicitada es mayor a la cantidad de inventario');
                    }
                    $producto ->decrement('amount', $movement->amount);
                    break;
            }
            $producto->save();
            $this->checkLowStock($producto);
        } catch(\Throwable $ex){
            Log::error('Error al tratar de realziar el movimiento');
            Session::flash('error', $ex->getMessage());
            DB::rollback();
        }
        DB::commit();
        return redirect()->route('movimientos.index');    
        }

    /**
     * Display the specified resource.
     */
    public function show(Movement $movement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movement $movement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movement $movement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movement $movement)
    {
        //
    }

    private function checkLowStock($product){
        if($product->amount <=10){
            Notification::route('mail','juandah0102@gmail.com')
            ->notify(new StockProduct($product));
        }
    }

    public function pdf($id){
        $movement = Product::find($id);
        $pdf = PDF::loadView('movimientos.pdf-mov', compact('movement'));
        return $pdf->stream('movement' .$movement->id.'pdf');
    }

    // public function pdff(){
    //     $movement = Product::find()
    // }
}

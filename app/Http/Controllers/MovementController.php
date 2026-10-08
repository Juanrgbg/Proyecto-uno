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
        return view('movements.index', ['movements' => $movements]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('movements.create', [
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

        $product = Product::find($request->producto);
        try {
            switch($movement->type){
                case Movement :: MOVEMENT_TYPE_IN:
                case Movement :: MOVEMENT_TYPE_DEVOLUTION:
                    $product->increment('amount', $movement->amount);
                    break;
                case Movement :: MOVEMENT_TYPE_OUT:
                    if($product->amount < $movement->amount){
                        throw new Exception("La cantidad solicitada es mayor a la cantidad del inventario");
                    }
                    $product -> decrement('amount', $movement->amount);
                    break;
            }
            $product->save();
            $this->checkLowStock($product);
        } catch (\Throwable $ex) {
            Log::error('Error al tratar de realizar el movimiento');
            Session::flash('error', $ex->getMessage());
            DB::rollBack();
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
        if ($product->amount <= 10) {
            Notification::route('mail', 'samuelhernandezhc.13@gmail.com')
            ->notify(new StockProduct($product));
        }
    }

    public function pdf($id){
        $movement = Movement::find($id);
        $pdf_movement = PDF::loadview('movements.pdf', compact('movement'));
        return $pdf_movement->stream('movement' .$movement->id.'pdf');
    }

    public function pdfall(){
        $movements = Movement::all();
        $pdf_general = PDF::loadView('movements.pdfall', compact('movements'));
        return $pdf_general->stream('movements' .$movements.'pdf');
    }

}

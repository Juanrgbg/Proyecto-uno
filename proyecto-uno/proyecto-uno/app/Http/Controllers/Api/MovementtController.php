<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovementtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movements = Movement::all();
        return response()->json(['movements' => $movements], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $movement = new Movement();
            $movement->type = $request->type;
            $movement->amount = $request->amount;
            $movement->sale_point = $request->sale_point;
            $movement->product_id = $request->product;
            $movement->save();

            $product = Product::find($request->product);

            switch($movement->type){
                case Movement::MOVEMENT_TYPE_IN:
                    case Movement::MOVEMENT_TYPE_DEVOLUTION:
                        $product->increment('amount', $movement->amount);
                        break;
                    case Movement::MOVEMENT_TYPE_OUT:
                        if($product->amount < $movement->amount){
                            throw new Exception("La cantidad solicitada es mayor a la disponible");
                        }
                        $product->decrement('amount', $movement->amount);
                        break;

            }
            $product->save();
            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => 'Movimiento realizado de forma correcta',
                'movement' => $movement,
                'product' => $product
            ], 201);
        } catch (\Throwable $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

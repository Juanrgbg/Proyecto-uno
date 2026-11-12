@extends('layout.layout')
@section('title','Agregar Movimiento')


@section('content')

<div class="container mt-4">
    <h4 class="text-center mb-4">Crear Movimientos</h4>
    <form action="{{ route('movimientos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="type">Seleccione el tipo de Movimiento</label>
                <select name="type" id="type" class="form-select">
                    @foreach ( $movements_type as $type )
                    <option value="{{ $type }}">{{mb_strtoupper ($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="amount">Cantidad</label>
                <input type="number" id="amount" name="amount" min="0" class="form-control" placeholder="Ej.100">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="sale_point">Caja</label>
                <select name="sale_point" id="sale_point" class="form-select">
                    <option value="" disabled selected>Seleccione punto de transaccion</option>
                    <option value="1">Caja 1</option>
                    <option value="2">Caja 2</option>
                    <option value="3">Caja 3</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="prodcuto">Producto</label>
                <select name="producto" id="producto" class="form-select">
                    <option value="" disabled selected>Escoge un producto</option>
                    @foreach ( $products as $producto )
                    <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                    @endforeach
                    <option value=""></option>
                </select>
            </div>
            <div class="text-center mb-3"> 
                <button class="btn btn-outline-priymar">Crear</button>
                <a href="{{ route('movimientos.index') }}" class="btn btn-outline-secondary">Volver</a>
            </div>
        </div>
    </form>
</div>
    
@endsection
@extends('layout.layout')
@section('title','Agregar Movimiento')
@section('content')

<div class="container mt-4">
    <h4 class="text-center mb-4">Crear Movimiento</h4>
    <form action="{{ route('movimientos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="type">Seleccione el tipo de movimiento</label>
                <select name="type" id="type" class="form-select">
                    @foreach($movements_type as $type)
                        <option value="{{ $type }}">{{ mb_strtoupper ($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="amount">Cantidad</label>
                <input type="number" min="0" name="amount" id="amount" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sale_point">Caja</label>
                    <select name="sale_point" id="sale_point" class="form-control">
                        <option value="" disabled selected>Seleccione Punto de Transaccion</option>
                        <option value="1">Caja 1</option>
                        <option value="2">Caja 2</option>
                        <option value="3">Caja 3</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="producto">Producto</label>
                    <select name="producto" id="producto" class="form-select">
                        <option value="" disabled selected>Escoja un Producto</option>
                        @foreach ($products as $producto )
                            <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary">Crear</button>
                    <a href="{{ route('movimientos.index') }}" class="btn btn-outline-secondary">Volver</a>
                </div>
            </div>
        </div>
    </form>
</div>












@endsection
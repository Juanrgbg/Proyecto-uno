@extends('layout.layout')
@section('title','Agregar Producto')
@section('content')

<div class="container">

    <div class="text-center" mt="5px">
        <h4>Crear Producto</h4>
    </div>

    <form action="{{ route('productos.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="code">Codigo</label>
                <input type="text" name="code" id="code" class="form-control" placeholder="Ej.COD001">
            </div>
            <div class="col-md-6 mb-3">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Ej.Portatil Hp">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="amount">Cantidad</label>
                <input type="number" name="amount" id="amount" class="form-control" placeholder="Ej.10">
            </div>
            <div class="col-md-6 mb-3">
                <label for="unit">Unidad de Medida</label>
                <select class="form-select" name="unit" id="unit">
                <option selected>Escoja una opcion de unidad</option>
                <option value="Und">Und</option>
                <option value="Kg">Kg</option>
                <option value="Gr">Gr</option>
                <option value="Pack">Pack</option>
                <option value="Lb">Lb</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price">Precio</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Ej.1000">
            </div>
            <div class="col-md-6 mb-3">
                <label for="supplier_id">Proveedor</label>
                <select name="supplier_id" id="supplier_id" class="form-control">
                    <option value="" disabled selected>Seleccione un Proveedor</option>
                    @foreach ( $suppliers as $supplier )
                        <option value="{{ $supplier->id }}">{{ $supplier->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center mt4">
                <button class="btn btn-outline-primary">Guardar</button>
                <a href="{{ route('productos.index') }}"><button type="button" class="btn btn-secondary">Volver</button></a>
            </div>
        </div>

    </form>
</div>









@endsection
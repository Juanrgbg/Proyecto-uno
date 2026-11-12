@extends('layout.layout')
@section('title','Editar Productos')

@section('content')
<br>
<div class="container">

    <div class="text-center" mt="5px">
        <h4>Crear Producto</h4>
    </div>

    <form action="{{ route('productos.update',$producto) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="code">Codigo</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code',$producto->code) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('code', $producto->name) }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="amount">Cantidad</label>
                <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount',$producto->amount)}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="unit">Unidad de Medida</label>
                <select class="form-select" name="unit" id="unit">
                <option value="Und"{{ old('unit',$producto->unit) == 'Und' ? 'selected': '' }}>Und</option>
                <option value="Kg"{{ old('unit',$producto->unit) == 'Kg' ? 'selected' : '' }}>Kg</option>
                <option value="Gr" {{ old('unit',$producto->unit) == 'Gr' ? 'selected' : '' }}>Gr</option>
                <option value="Pack" {{ old('unit',$producto->unit) == 'Pack' ? 'selected' : '' }}>Pack</option>
                <option value="Lb" {{ old('unit',$producto->unit)== 'Lb' ? 'selected' : "" }}>Lb</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price">Precio</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price',$producto->price) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="supplier">Proveedor</label>
                <select name="supplier" id="supplier" class="form-control">
                    <option value="" disabled {{ !$producto ->supplier_id ? 'selected' : '' }} >Seleccione un proveedor</option>

                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id}}" {{ $producto->supplier_id == $supplier->id ? 'selected' : '' }}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="text-left ">
                <label for="image">Elige una imagen: </label>
                <br>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <div class="text-center mt4">
                <button class="btn btn-outline-primary">Guardar</button>
                <a href="{{ route('productos.index') }}"><button type="button" class="btn btn-secondary">Volver</button></a>
            </div>

            
        </div>

    </form>
</div>

@endsection

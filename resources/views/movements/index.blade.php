@extends('layout.layout')
@section('title','Lista de Movimientos')

@section('content')

@if(Session::has('error'))
    <p style="padding: 10px; background-color:red; color: white">{{ Session::get('error') }}</p>    
@endif

<div class="container mt-4">
<a href="{{ route('movimientos.create') }}"><button type="button" class="btn btn-secondary">Agregar</button></a>

<table class="table table-striped mt-4">
    <thead class="thead-dark">
    <tr>
        <th>Id</th>
        <th>Tipo</th>
        <th>Cantidad</th>
        <th>Caja</th>
        <th>Producto</th>
        <th>Existencia</th>
        <th>Alarma</th>
    </tr>
</thead>
<tbody>
    @foreach($movements as $movement) 
    <tr>
        <td>{{ $movement->id }}</td>
        <td>{{ $movement->type }}</td>
        <td>{{ $movement->amount }}</td>
        <td>{{ $movement->sale_point }}</td>
        <td>{{ $movement->product? $movement->product->name: 'Sin Producto' }}</td>
        <td>{{ $movement->product? $movement->product->amount: 'Sin Existencia' }}</td>
        <td>{!! $movement->product?->amount <= 10
            ? "<i class = 'bi bi-bell-fill' style = 'color: #e10909;'></i>"
            : "<i class = 'bi bi-check-circle-fill' style = 'color: #5af109;'></i>"!!}
        </td>
    </tr>
    @endforeach
</tbody>
</table>
<div>
    {{ $movements->links() }}
</div>


</div>











@endsection
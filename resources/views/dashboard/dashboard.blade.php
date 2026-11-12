@extends('layout.layout')
@section('title', 'Dashboard Inventario')
@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Dashboard Inventario</h2>

    {{-- Tarjetas --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card bg-dark text-white shadow">
                <div class="card-body">
                    <h5>Total Productos</h5>
                    <h2>{{ $totalProducts }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h5>Stock Critico</h5>
                    <h2>{{ $criticalCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <h5>Stock Medio</h5>
                    <h2>{{ $warningCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Stock Normal</h5>
                    <h2>{{ $normalCount }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Productos Criticos --}}
    <div class="card shadow border-danger">
        <div class="card-header bg-danger text-white">
            Productos Criticos
        </div>
        <div class="card-body">
            {{-- Condicional para filtrar productos criticos --}}
            {{-- <div class="alert alert-success">
                No hay productos criticos
            </div> --}}
            {{-- Aca va el else --}}
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Aca va el ciclo para recorrer los productos criticos --}}
                    @foreach ( $products as $product )
                    <tr>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->amount }}</td>
                        <td><span class="badge bg-danger">CRITICO</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
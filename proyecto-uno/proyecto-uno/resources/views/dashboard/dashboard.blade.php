@extends('layout', 'layout')

@section('title', 'Dashboard Inventario')

@section('content')

<div class="container m-4">
    <h2 class="mb-4">Dashboard Inventario</h2>

    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card bg-dark text-white shadow">
                <h5>Total productos</h5>
                <h2> {{ $totalProducts }}</h2>

            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h5>Stock Critico</h5>
                <h2>{{ $warningProducts }}</h2>
            </div>
        </div>
    </div>

    <div class="col md-3">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h5>Stock Medio</h5>
                <h2>{{ $normalProducts }}</h2>
            </div>
        </div>
    </div>

    <div class="col md-3">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h5>Stock Normal</h5>
                <h2>{{ $normalProducts }}</h2>
            </div>
        </div>
    </div>
      

</div>
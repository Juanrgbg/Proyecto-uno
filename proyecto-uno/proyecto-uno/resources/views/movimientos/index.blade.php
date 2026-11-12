@extends('layout.layout')
@section('title','Lista de Movimientos')

@section('content')

@if (Session::has('error'))
<p style="padding: 10px; background-color: red; color: white;">{{ Session::get('error') }}</p>
@endif


<div class="container mt-4">
    <a href="{{ route('movimientos.create') }}"><button type="button" class="btn btn-secondary">Agregar</button></a>
    
    <a href=""><button type="button" class="btn btn-danger">PDF</button></a>
    <table class="table table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Caja</th>
                <th>Producto</th>
                <th>Existencia</th>
                <th>Alarma</th>
                <th>utilidades</th>
            </tr>
        </thead>
        @foreach ($movements as $movement )
            
        <tr>
            <td>{{ $movement->id }}</td>
            <td>{{ $movement->type }}</td>
            <td>{{ $movement->amount }}</td>
            <td>{{ $movement->sale_point }}</td>
            <td>{{ $movement->product? $movement->product->name : 'Sin nombre'}}</td>
            <td>{{ $movement->product? $movement->product->amount : 'Sin cantidad' }}</td>
            <td>{!! $movement ->product->amount <= 10
                ?'📣'
                :'✅'!!}
            </td>

            <td class="d-flex justify-content-start">
                <a href=" {{  route('productos.edit',$movement->id )}}"><button class="btn btn-primary" ><i class="bi bi-pen"></i></button></a>&nbsp

                <form action="{{ route('productos.destroy', $movement) }}" method="POST" 
                    onsubmit="return confirm('estas seguro de eliminar el producto' {{$movement->name}})">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="bi bi-trash3"></i></button>&nbsp   
                </form>

                <button class="btn btn-outline-info btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#infoModal"
                    {{-- data-id = "{{ $product->id }}" --}}
                    data-code ="{{ $movement->id }}"
                    data-name ="{{ $movement->type }}"
                    data-amount = "{{ $movement->amount }}"
                    {{-- data-unit = "{{ $product->unit }}" --}}
                    data-price="{{ $movement->price }}"
                    data-supplier="{{ $movement->supplier->name ?? 'Sin Proveedor' }}"


                    title="Ver detalle"
            <td/>
            <td>
                <a href="{{ route('pdf-mov',$movement->id) }}" target="_blank"  title="Generar PDF">Generar</a><i class="bi bi-filetype-pdf"></i>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $movements->links() }}
    </div>
    <div class="modal fade" tabindex="-1" id="infoModal" aria-labelledby="infoModalLavel" arial-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModaLabel">Detalles del producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss ="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="id" class="mb-2"></p>
                <p id="code" class="mb-2"></p>
                <p id="name" class="mb-2"></p>
                <p id="amount" class="mb-2"></p>
                <p id="unit" class="mb-2"></p>
                <p id="price" class="mb-2"></p>
                <p id="supplier" class="mb-2"></p>
                <p id="image" class="mnb-0"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const infoModal = document.getElementById('infoModal');

            if(infoModal){
                infoModal.addEventListener('show.bs.modal', function(event){
                    const button =event.relatedTarget;
                    if(!button) return;

                    const id = button.getAttribute('data-id') || '';
                    const code = button.getAttribute('data-code') || '';
                    const name = button.getAttribute('data-name') || '';
                    const amount = button.getAttribute('data-amount') || '';
                    const unit = button.getAttribute('data-unit') || '';
                    const price = button.getAttribute('data-price') || '';
                    const supplier = button.getAttribute('data-supplier') || '';

                    document.getElementById('id').innerHTML = '<strong> Id: </strong>' + id;
                    document.getElementById('code').innerHTML = '<strong> Codigo: </strong>' + code;
                    document.getElementById('name').innerHTML = '<strong> Nombre: </strong>' + name;
                    document.getElementById('amount').innerHTML = '<strong> Cantidad: </strong>' + amount;
                    document.getElementById('unit').innerHTML = '<strong> Unidad: </strong>' + unit;
                    document.getElementById('price').innerHTML = '<strong> Precio: </strong>' + price;
                    document.getElementById('supplier_name').innerHTML = '<strong> Proveedor: </strong>' + supplier;
                    document.getElementById('image').innerHTML = '<strong> imagen: </strong>' + image;

                    

                    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('infoModal'));
                    modal.show();
                });   
            }
        })
    </script>
@endsection
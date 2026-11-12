@extends('layout.layout')
@section('title','Lista de Productos')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<br>


<div class="container mt-4">
    <a href="{{ route('productos.create') }}"><button type="button" class="btn btn-secondary">Agregar</button></a>
<table class="table table-striped">
    <thead>
        <tr>
            {{-- <th scope="col">ID</th> --}}
            <th scope="col">Codigo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Unidad Medida</th>
            <th scope="col">Precio</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Imagen</th>
            <th scope="col">Acciones</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product )
            
        <tr>
            {{-- <td>{{ $product->id }}</td> --}}
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{!!$product->amount <= 100
            ?' <i class="fa-solid fa-bell" style=" #e10909;"></i> ' . $product->amount
            :'<i class ="fa-solid fa-thumbs-up" style="color: #5af109"></i>' . $product->amount !!}
            </td>
            <td>{{ $product->unit }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->supplier->name ?? 'Sin Proveedor' }}</td>
            <td>{{ $product->image }}</td> 
            
            
            <td class="d-flex justify-content-start">
                <a href=" {{  route('productos.edit',$product->id )}}"><button class="btn btn-primary" ><i class="bi bi-pen"></i></button></a>&nbsp

                <form action="{{ route('productos.destroy', $product) }}" method="POST" 
                    onsubmit="return confirm('estas seguro de eliminar el producto' {{$product->name}})">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="bi bi-trash3"></i></button>&nbsp
                    
                </form>

                <button class="btn btn-outline-info btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#infoModal"
                    {{-- data-id = "{{ $product->id }}" --}}
                    data-code ="{{ $product->code }}"
                    data-name ="{{ $product->name }}"
                    data-amount = "{{ $product->amount }}"
                    {{-- data-unit = "{{ $product->unit }}" --}}
                    data-price="{{ $product->price }}"
                    data-supplier="{{ $product->supplier->name ?? 'Sin Proveedor' }}"
                    data-image="{{ $product->image }}"

                    title="Ver detalle"

                    

                ><i class="bi bi-eye-fill"></i></button>&nbsp

                    <a href="{{ route('pdf',$product->id) }}" target="_blank"  title="Generar PDF"></a><button class="btn btn-light btn-sm border"><i class="bi bi-filetype-pdf"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $products->links() }}
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
                    const image = button.getAttribute('data-image') || '';

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
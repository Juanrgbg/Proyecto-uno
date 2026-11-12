@extends('layout.layout')
@section('title','Lista de Productos')

@section('content')
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
           {{-- <th scope="col">Unidad Medida</th> --}}
           <th scope="col">Precio</th>
           <th scope="col">Proveedor</th>
           <th scope="col">Acciones</th> 
        </tr>
    </thead>
    <tbody>
        @foreach ( $products as $product )
            
        <tr>
            {{-- <td>{{ $product->id }}</td> --}}
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{!!$product->amount <= 10
            ? "<i class = 'bi bi-bell-fill' style = 'color: #e10909;'></i>" . $product->amount
            : "<i class = 'bi bi-check-circle-fill' style = 'color: #5af109;'></i>" . $product->amount !!}
            </td>
            {{-- <td>{{ $product->unit }}</td> --}}
            <td>{{ $product->price }}</td>
            <td>{{ $product->supplier?->nombre ?? 'Sin Proveedor' }}</td>
            <td class="d-flex justify-content-start">
                <a href="{{ route('productos.edit', ['producto' => $product->id]) }}"><button class="btn btn-primary"><i class="bi bi-pencil"></i></button></a>&nbsp;


                <form action="{{ route('productos.destroy', $product) }}" method="POST" onsubmit="return confirm('Estas seguro de eliminar el producto {{ $product->name }} ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="bi bi-eraser-fill"></i></button>&nbsp;
                </form>

                <button type="button" class="btn btn-outline-info btn-sm"
                data-bs-toggle = "modal"
                data-bs-target = "#infoModal"
                data-id = "{{ $product->id }}"
                data-code = "{{ $product->code }}"
                data-name = "{{ $product->name }}"
                data-amount = "{{ $product->amount }}"
                data-unit = "{{ $product->unit }}"
                data-price = "{{ $product->price }}"
                data-supplier = "{{ $product->supplier?->nombre ?? ' Sin Proveedor ' }}"
                title="Ver detalle"

                ><i class="bi bi-eye-fill"></i></button>&nbsp;

                <a href="{{ route('pdf', $product->id ) }}" target="_blank" class="btn btn-light btn-sm border" title="Generar PDF"><i class="bi bi-file-earmark-pdf"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $products->links() }}
</div>

<div class="modal fade" tabindex="-1" id="infoModal" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">Detalle del Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="id" class="mb-2"></p>
        <p id="code" class="mb-2"></p>
        <p id="name" class="mb-2"></p>
        <p id="amount" class="mb-2"></p>
        <p id="unit" class="mb-2"></p>
        <p id="price" class="mb-2"></p>
        <p id="supplier" class="mb-0"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const infoModal = document.getElementById('infoModal');
        if(infoModal){
            infoModal.addEventListener('show.bs.modal', function(event){
                const button = event.relatedTarget;
                if(!button) return;

                const id = button.getAttribute('data-id') || '';
                const code = button.getAttribute('data-code') || '';
                const name = button.getAttribute('data-name') || '';
                const amount = button.getAttribute('data-amount') || '';
                const unit = button.getAttribute('data-unit') || '';
                const price = button.getAttribute('data-price') || '';
                const supplier = button.getAttribute('data-supplier') || '';

                document.getElementById('id').innerHTML = '<strong>Id: </strong>' + id;
                document.getElementById('code').innerHTML = '<strong>Codigo: </strong>' + code;
                document.getElementById('name').innerHTML = '<strong>Nombre: </strong>' + name;
                document.getElementById('amount').innerHTML = '<strong>Cantidad: </strong>' + amount;
                document.getElementById('unit').innerHTML = '<strong>Unidad: </strong>' + unit;
                document.getElementById('price').innerHTML = '<strong>Precio: </strong>' + price;
                document.getElementById('supplier').innerHTML = '<strong>Proveedor: </strong>' + supplier;
                

                const modal = bootstrap.modal.getOrCreateInstance(document.getElementById('infoModal'));
                modal.show();

            });
        }
    })
</script>



@endsection
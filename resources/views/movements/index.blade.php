@extends('layout.layout')
@section('title','Lista de Movimientos')

@section('content')

@if(Session::has('error'))
    <p style="padding: 10px; background-color:red; color: white">{{ Session::get('error') }}</p>    
@endif

<div class="container mt-4">
<a href="{{ route('movimientos.create') }}"><button type="button" class="btn btn-secondary">Agregar</button></a>

<a href="{{ route('pdfall') }}" class="btn btn-success" target="_blank">PDF</a> 




<table class="table table-striped mt-4">
    <thead class="thead-dark">
    <tr>
        {{-- <th>Id</th> --}}
        {{-- <th>Tipo</th> --}}
        <th>Cantidad</th>
        <th>Caja</th>
        <th>Producto</th>
        <th>Existencia</th>
        <th>Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach($movements as $movement) 
    <tr>
        {{-- <td>{{ $movement->id }}</td> --}}
        {{-- <td>{{ $movement->type }}</td> --}}
        <td>{{ $movement->amount }}</td>
        <td>{{ $movement->sale_point }}</td>
        <td>{{ $movement->product? $movement->product->name: 'Sin Producto' }}</td>
        <td>{{ $movement->product? $movement->product->amount: 'Sin Existencia' }}</td>
        <td>{!! $movement->product?->amount <= 10
            ? "<i class = 'bi bi-bell-fill' style = 'color: #e10909;'></i>"
            : "<i class = 'bi bi-check-circle-fill' style = 'color: #5af109;'></i>"!!}

            <button type="button" class="btn btn-outline-info btn-sm"
                data-bs-toggle = "modal"
                data-bs-target = "#infoModal"
                data-id = "{{ $movement->id }}"
                data-type = "{{ $movement->type }}"
                data-amount = "{{ $movement->amount }}"
                data-sale_point = "{{ $movement->sale_point }}"
                data-name = "{{ $movement->product? $movement->product->name: 'Sin Producto' }}"
                title="Ver detalle"

                ><i class="bi bi-eye-fill"></i></button>&nbsp;

                <a href="{{ route('pdf_movement', $movement->id ) }}" target="_blank" class="btn btn-light btn-sm border" title="Generar PDF"><i class="bi bi-file-earmark-pdf"></i></a>
 
    @endforeach
</tbody>
</table>
<div>
    {{ $movements->links() }}
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
        <p id="type" class="mb-2"></p>
        <p id="amount" class="mb-2"></p>
        <p id="sale_point" class="mb-2"></p>
        <p id="name" class="mb-0"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
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
                const type = button.getAttribute('data-type') || '';
                const amount = button.getAttribute('data-amount') || '';
                const sale_point = button.getAttribute('data-sale_point') || '';
                const name = button.getAttribute('data-name') || '';

                document.getElementById('id').innerHTML = '<strong>Id: </strong>' + id;
                document.getElementById('type').innerHTML = '<strong>Tipo: </strong>' + type;
                document.getElementById('amount').innerHTML = '<strong>Cantidad: </strong>' + amount;
                document.getElementById('sale_point').innerHTML = '<strong>Punto de venta: </strong>' + sale_point;
                document.getElementById('name').innerHTML = '<strong>Nombre: </strong>' + name;
                

                const modal = bootstrap.modal.getOrCreateInstance(document.getElementById('infoModal'));
                modal.show();
     
            });
        }
    })
</script>


@endsection
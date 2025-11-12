@extends('template.base')

@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Borrando CV</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Estas a punto de eliminar este CV, ¿estás seguro de que lo quieres hacer?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cerrar</button>
        <button form="form-delete" type="submit" class="btn btn-danger">Eliminar CV</button>
      </div>
    </div>
  </div>
</div>

<table class="table table-hover">

    <thead>
        <tr style=text-align:center;>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre Completo</th>
            <th>Nota Media</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody> 
        @forelse($curriculums as $curriculum)<!-- Intenta recorrer la colección $curriculums -->
        <tr style=text-align:center;>
            <td >{{ $curriculum->id }}</td>
            <!-- {{ $curriculum->path ? asset('storage/' . $curriculum->path) : asset('assets/img/sin-foto.webp') }} || 
                 Esto quiere decir: si $curriculum->path tiene valor genera la url a la foto que se subio, si no, se le asigna imagen por defecto  -->
            <td><img class="card-img-top"
                src="{{ $curriculum->path ? asset('storage/' . $curriculum->path) : asset('assets/img/sin-foto.webp') }}" 
                alt="Foto de {{ $curriculum->nombre }}"
                style="height:50px; width:50px; border-radius:10px;"></td>
            <td>{{ $curriculum->nombre }} {{ $curriculum->apellidos }}</td>
            <td>{{ $curriculum->nota_media }}</td>
            <td>
                <a href="{{ route('curriculum.show', $curriculum->id) }}" class="btn btn-outline-success">view</a>
                <a href="{{ route('curriculum.edit', $curriculum->id) }}" class="btn btn-outline-warning">edit</a>
                <a data-title="{{$curriculum->title}}" data-href="{{ route('curriculum.destroy', $curriculum->id) }}" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</a>
            </td>
        </tr>
        @empty <!-- Si $curriculums está vacío, muestra esto en su lugar -->
            <p class="text-center">No hay currículums registrados.</p>
        @endforelse
    </tbody>

    <tfoot>
        <tr>
            <th colspan="3">Number of curriculum items:</th>
            <th colspan="1" style=text-align:end;>{{ count($curriculums) }}</th>
        </tr>
    </tfoot>

    <form id="form-delete" action="" method="post">
        @csrf
        @method('DELETE')
    </form>
    
</table>

@endsection

@section('scripts')
    <script>
        // Espera a que el documento HTML esté completamente cargado
        document.addEventListener('DOMContentLoaded', function () {
            // Selecciona todos los botones que abren el modal de borrado
            const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteModal"]');
            // Selecciona el formulario que se usará para enviar la petición DELETE
            const formDelete = document.getElementById('form-delete');

            // Recorre cada botón de "delete"
            deleteButtons.forEach(button => {
                // Añade un listener para cuando se haga clic en él
                button.addEventListener('click', function () {
                    // Cuando se hace clic, obtiene la URL guardada en el atributo 'data-href' del botón específico     
                    const action = this.getAttribute('data-href');
                    // Asigna esa URL específica al atributo 'action' del formulario de borrado
                    formDelete.setAttribute('action', action);
                });
            });
        });
    </script>
@endsection

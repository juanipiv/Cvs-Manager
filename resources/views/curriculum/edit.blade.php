@extends('template.base')

@section('content')
<form action="{{ route('curriculum.update', $curriculum->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Añade tu nombre..." maxlength="20" value="{{ old('nombre', $curriculum->nombre) }}" required>
    </div>

    <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos:</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Añade tus apellidos..." maxlength="60" value="{{ old('apellidos', $curriculum->apellidos) }}" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Añade tu número de teléfono..." maxlength="20" value="{{ old('telefono', $curriculum->telefono) }}" required>
        <div id="telefonoHelp" class="form-text">No compartiremos tu número de teléfono con nadie más.</div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Dirección de correo:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Añade tu email..." value="{{ old('email', $curriculum->email) }}" required>
        <div id="emailHelp" class="form-text">No compartiremos tu dirección de correo con nadie más.</div>
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $curriculum->fecha_nacimiento) }}" required>
    </div>

    <div class="mb-3">
        <label for="nota_media" class="form-label">Nota media:</label>
        <input type="number" class="form-control" id="nota_media" name="nota_media" placeholder="Añade tu nota media..." min="0" max="10" step="0.1" value="{{ old('nota_media', $curriculum->nota_media) }}" required>
    </div>

    <div class="mb-3">
        <label for="experiencia" class="form-label">Experiencia:</label>
        <textarea class="form-control" id="experiencia" name="experiencia" placeholder="Cuéntanos sobre tu experiencia...">{{ old('experiencia', $curriculum->experiencia) }}</textarea>
    </div>
    
    <div class="mb-3">
        <label for="formacion" class="form-label">Formación:</label>
        <textarea class="form-control" id="formacion" name="formacion" placeholder="Cuéntanos sobre tu formacion profesional...">{{ old('formacion', $curriculum->formacion) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="habilidades" class="form-label">Habilidades:</label>
        <textarea class="form-control" id="habilidades" name="habilidades" placeholder="Cuéntanos sobre tus habilidades...">{{ old('habilidades', $curriculum->habilidades) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Foto actual:</label><br>
        @if($curriculum->path)
            <img src="{{ asset('storage/' . $curriculum->path) }}" alt="Foto actual" width="150" class="mb-2">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remove_image" name="remove_image" value="1">
                <label class="form-check-label" for="remove_image">Eliminar foto actual</label>
            </div>
        @else
            <p>No hay foto subida.</p>
        @endif
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Cambiar foto:</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <small class="form-text text-muted">Si seleccionas una nueva imagen, reemplazará la actual.</small>
    </div>

    <button type="submit" class="btn btn-primary">Editar</button>
</form>
@endsection

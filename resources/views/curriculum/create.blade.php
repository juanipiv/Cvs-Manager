@extends('template.base')

@section('content')
<form action="{{ route('curriculum.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Añade tu nombre..." maxlength="20" value="{{ old('nombre') }}" required>
    </div>

    <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos:</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Añade tus apellidos..." maxlength="60" value="{{ old('apellidos') }}" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Añade tu número de teléfono..." maxlength="20" value="{{ old('telefono') }}" required>
        <div id="telefonoHelp" class="form-text">No compartiremos tu número de teléfono con nadie más.</div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Dirección de correo:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Añade tu email..." value="{{ old('email') }}" required>
        <div id="emailHelp" class="form-text">No compartiremos tu dirección de correo con nadie más.</div>
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
    </div>

    <div class="mb-3">
        <label for="nota_media" class="form-label">Nota media:</label>
        <input type="number" class="form-control" id="nota_media" name="nota_media" placeholder="Añade tu nota media..." min="0" max="10" step="0.1" value="{{ old('nota_media') }}" required>
    </div>

    <div class="mb-3">
        <label for="experiencia" class="form-label">Experiencia:</label>
        <textarea class="form-control" id="experiencia" name="experiencia" placeholder="Cuéntanos sobre tu experiencia...">{{ old('experiencia') }}</textarea>
    </div>
    
    <div class="mb-3">
        <label for="formacion" class="form-label">Formación:</label>
        <textarea class="form-control" id="formacion" name="formacion" placeholder="Cuéntanos sobre tu formacion profesional...">{{ old('formacion') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="habilidades" class="form-label">Habilidades:</label>
        <textarea class="form-control" id="habilidades" name="habilidades" placeholder="Cuéntanos sobre tus habilidades...">{{ old('habilidades') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Foto tuya:</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Añadir</button>
</form>
@endsection

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
        <!-- Zona de arrastrar VISIBLE -->
        <div id="drop-zone" class="border border-secondary rounded d-flex flex-column align-items-center justify-content-center p-4 text-center"
            style="cursor: pointer; background-color: #f8f9fa;">
            <p class="mb-2" id="drop-text">Arrastra tu imagen aquí o haz clic para seleccionarla</p>

            <!-- Imagen previa -->
            <!-- src="{{ isset($curriculum) && $curriculum->path ? asset('storage/' . $curriculum->path) : asset('assets/img/sin-foto.webp') }}" 
                 comprueba si la variable $curriculum existe y si ese curriculum tiene una foto, en caso de que si muestra la foto existente, 
                 en caso de que alguna de las dos sea falsa muestra la imagen por defecto. -->
            <img id="preview" 
                src="{{ isset($curriculum) && $curriculum->path ? asset('storage/' . $curriculum->path) : asset('assets/img/sin-foto.webp') }}"
                alt="Vista previa"
                class="img-thumbnail mt-2"
                style="display: block; max-width: 200px; height: auto;">
        </div>

        <!-- Input de archivo oculto que realmente es el campo del formulario -->
        <input type="file" id="image" name="image" accept="image/*" class="d-none">
    </div>

    <button type="submit" class="btn btn-primary">Añadir</button>
</form>
@endsection

@section('scripts')
    <script>
        // Espera a que el documento HTML esté completamente cargado
        document.addEventListener('DOMContentLoaded', function () {
            // Guarda en variables las referencias a los elementos HTML
            // con los que vamos a interactuar para no tener que buscarlos 
            // cada vez.

            // La zona visible donde el usuario puede arrastrar o hacer clic
            const dropZone = document.getElementById('drop-zone');
            // El <input type="file" id="image"> real, que está oculto.
            const inputFile = document.getElementById('image');
            // La etiqueta <img> que mostrará la vista previa.
            const preview = document.getElementById('preview');
            // El párrafo <p> que muestra el texto de ayuda.
            const dropText = document.getElementById('drop-text');

            // Al hacer clic en la zona visible, abre el selector de archivos 
            dropZone.addEventListener('click', () => inputFile.click());
            // inputFile.click() simula un clic en el input de archivo oculto (inputFile)
            // abriendo asi el buscador de archivos

            // Cuando el valor del input del archivo cambia (cuando el usuario ha seleccionado un archivo)
            inputFile.addEventListener('change', (event) => {
                // obtenemos el primer archivo seleccionado y llamamos a la funcion handleFile para procesarlo
                handleFile(event.target.files[0]);
            });

            // Para que el "drag & drop" funcione, necesitamos evitar que el navegador haga su acción por defecto
            // como puede llegar a ser el archivo en una nueva pestaña
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
                // Evita la accion por defecto
                dropZone.addEventListener(evt, e => e.preventDefault());
                // Detiene la propagación del evento
                dropZone.addEventListener(evt, e => e.stopPropagation());
            });

            // Efecto visual al arrastrar

            // Cuando un archivo entra o esta sobre la zona
            ['dragenter', 'dragover'].forEach(evt => {
                // Añade la clase 'border-primary'
                dropZone.addEventListener(evt, () => dropZone.classList.add('border-primary'));
            });
            // Cuando el archivo sale de la zona o se suelta 
            ['dragleave', 'drop'].forEach(evt => {
                // Le quita la clase 'border-primary'
                dropZone.addEventListener(evt, () => dropZone.classList.remove('border-primary'));
            });

            // Cuando suelta el archivo
            dropZone.addEventListener('drop', (e) => {
                // Se obtiene el archivo soltado desde el evento
                const file = e.dataTransfer.files[0];
                // Asiganmos el archivo soltado al input oculto
                inputFile.files = e.dataTransfer.files; // para que se envíe con el form
                // Llamamos a la funcion handleFile para mostrar la vista previa
                handleFile(file);
            });

            // Funcion centralizada la logica para validar y mostrar la vista previa del archivo
            // sea que venga del 'change' o del 'drop'
            function handleFile(file) {
                // Si no hay archivo o no es una imagen, no se hace nada
                if (!file || !file.type.startsWith('image/')) {
                    alert('Por favor selecciona una imagen válida.');
                    return;
                }

                // Se usa la API FileReader para leer el archivo de forma local 
                const reader = new FileReader();
                // Cuando el 'reader' termine de leer:
                reader.onload = (e) => {
                    // 'e.target.result' contiene la imagen como data URL y asignamos ese Data URL al 'src' de la imagen de preview
                    preview.src = e.target.result;
                    // Se actualiza el texto para indicar que se cargo
                    dropText.textContent = 'Imagen seleccionada';
                };
                // Damos la orden al 'reader' de que empiece a leer el archivo y una vez que termine, se dispara el 'onload'
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

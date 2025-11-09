<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class curriculumController extends Controller
{
    function index(): View {
        $curriculums = Curriculum::all();//select * from curriculum;
        $array = ['curriculums' => $curriculums];
        return view('curriculum.index', $array);
        //return view('curriculum.index', compact('curriculums'));
    }
    
    function create(): View {
        return view('curriculum.create');
    }

    function store(Request $request): RedirectResponse {
        //eloquent
        // dd($request);
        $result = false;
        $curriculum = new Curriculum($request->all());
        try {
        $result = $curriculum->save(); // Guarda los datos primero

        // Solo sube imagen si el usuario la envió
            if ($request->hasFile('image')) {
                $path = $this->upload($request, $curriculum->id);
                $curriculum->path = $path;
                $curriculum->save(); // Actualiza el path
            }

            $message = 'Se ha añadido un nuevo CV';
        } catch(UniqueConstraintViolationException $e) {
            $message = 'Solo se puede introducir un único número de teléfono o email.';
        } catch(QueryException $e) {
            dd($e->getMessage());
            $message = 'No ha rellenado alguno de los campos obligatorios.';
        } catch(\Exception $e) {
            dd($e->getMessage());
            $message = 'Algo ha ocurrido, inténtelo más tarde.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('main.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }

    private function upload(Request $request, $id)
    {
        // Si no hay archivo, devolvemos null sin error
        if (!$request->hasFile('image')) {
            return null;
        }

        $image = $request->file('image');

        // Evitar errores si el archivo no es válido
        if (!$image->isValid()) {
            return null;
        }

        // Creamos el nombre y guardamos en /storage/app/public/images
        $fileName = $id . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('images', $fileName, 'public');

        return $path; // guardará algo como "images/3.jpg"
    }

    function show(Curriculum $curriculum): View {
        $year = Carbon::now()->year;
        return view('curriculum.show', ['curriculum' => $curriculum, 'year' => $year]);
    }

    function edit(Curriculum $curriculum ) {
        return view('curriculum.edit', ['curriculum' => $curriculum]);
    }

    public function update(Request $request, Curriculum $curriculum){
        try {
            // actualizamos los campos normales
            $curriculum->fill($request->except('image', 'remove_image'));
            $curriculum->save();

            // si marco eliminar foto
            if ($request->has('remove_image') && $request->remove_image == 1) {
                if ($curriculum->path && \Storage::disk('public')->exists($curriculum->path)) {
                    \Storage::disk('public')->delete($curriculum->path);
                }
                $curriculum->path = null;
                $curriculum->save();
            }

            // si sube una nueva imagen
            if ($request->hasFile('image')) {
                // borramos la anterior si existe
                if ($curriculum->path && \Storage::disk('public')->exists($curriculum->path)) {
                    \Storage::disk('public')->delete($curriculum->path);
                }

                $fileName = $curriculum->id . '.' . $request->file('image')->getClientOriginalExtension();
                $path = $request->file('image')->storeAs('images', $fileName, 'public');

                $curriculum->path = $path;
                $curriculum->save();
            }

            return redirect()->route('main.index')->with('success', 'Currículum actualizado correctamente.');

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Error al actualizar el currículum: ' . $e->getMessage()]);
        }
    }

    function destroy(Curriculum $curriculum) {
        try {
            $result = $curriculum->delete();
            $message = 'Se ha eliminado el CV';
        } catch(\Exception $e) {
            $result = false;
            $message = 'El CV no ha podido borrarse.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('main.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }


}

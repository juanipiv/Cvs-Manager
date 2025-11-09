<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model {

    protected $table = 'curriculum';

    //los campos que se rellenan manualmente
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'email',
        'fecha_nacimiento',
        'nota_media',
        'experiencia',
        'formacion',
        'habilidades',
        'path',
    ];

    // function getPath() {
    //     $url = url('assets/img/noticia.jpg');
    //     if($this->path != null) {
    //         $url = url('storage/' . $this->path);
    //     }
    //     return $url;
    // }
}
<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    function index(): View {
        $curriculums = Curriculum::all();
        return view('main.index', compact('curriculums'));
    }
}

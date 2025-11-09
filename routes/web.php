<?php

use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// main controller
Route::get('/', [MainController::class, 'index'])->name('main.index');

// curriculum controller

Route::resource('curriculum', CurriculumController::class);

// Route::get('curriculum', [CurriculumController::class, 'index'])->name('curriculum.index');
// Route::post('curriculum', [CurriculumController::class, 'store'])->name('curriculum.store');
// Route::get('curriculum/create', [CurriculumController::class, 'create'])->name('curriculum.create');
// Route::get('curriculum/{curriculum}/edit', [CurriculumController::class, 'edit'])->name('curriculum.edit');
// Route::get('curriculum/{curriculum}', [CurriculumController::class, 'show'])->name('curriculum.show');
// Route::put('curriculum/{curriculum}', [CurriculumController::class, 'update'])->name('curriculum.update');
// Route::delete('curriculum/{curriculum}', [CurriculumController::class, 'destroy'])->name('curriculum.destroy');
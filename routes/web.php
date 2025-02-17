<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/dosen')->middleware('auth')->group(function(){
    Route::get('/', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
});


Route::prefix('/mahasiswa')->middleware('auth')->group(function(){
    Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});


Route::get('/', function () {
    return view('welcome');
});
require __DIR__.'/auth.php';
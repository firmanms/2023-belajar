<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('artikel', ArtikelController::class);
    // Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    // Route::get('/artikel/create', [ArtikelController::class,'create'])->name('artikel.create');
    // Route::post('/artikel/store', [ArtikelController::class,'store'])->name('artikel.store');
    // Route::patch('/artikel{id}', [ArtikelController::class,'update'])->name('artikel.edit');
    Route::post('delete-artikel', [ArtikelController::class,'destroy']);
});

Route::get('admin', function () {
    return 'Admin Page';
})->middleware('auth', 'admin');
// Route::get('listartikel', function () {
//     return view('list-artikel');
// })->middleware(['auth', 'admin'])->name('listartikel');

require __DIR__.'/auth.php';

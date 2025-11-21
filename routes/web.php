<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Mostrar formulário de criação
    Route::get('/create', [ContactsController::class, 'create'])->name('contacts.create');
    // Armazenar novo contato
    Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store');
    // Mostrar formulário de edição
    Route::get('/contacts/{contact}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
    // Atualizar contato
    Route::put('/contacts/{contact}', [ContactsController::class, 'update'])->name('contacts.update');
    // Deletar contato
    Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy'])->name('contacts.destroy');
});


Route::get('/', [ContactsController::class, 'index'])->name('contacts.index');

require __DIR__.'/auth.php';

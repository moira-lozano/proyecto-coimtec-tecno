<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisteredUserController; 
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->name('cliente.dashboard');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');



// Clientes
Route::controller(ClienteController::class)->prefix('clientes')->name('clientes.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{cliente}', 'show')->name('show');
    Route::get('/{cliente}/edit', 'edit')->name('edit');
    Route::post('/{cliente}', 'update')->name('update'); // Notar POST aquí
    Route::delete('/{cliente}', 'destroy')->name('destroy');
});


// Usuarios
Route::controller(UsuarioController::class)->prefix('usuarios')->name('usuarios.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{usuario}', 'show')->name('show');
    Route::get('/{usuario}/edit', 'edit')->name('edit');
    Route::post('/{usuario}', 'update')->name('update'); // POST en lugar de PUT
    Route::post('/{usuario}', 'destroy')->name('destroy');
});
Route::get('/usuario/dashboard', [UsuarioController::class, 'dashboard'])->name('usuario.dashboard');



require __DIR__.'/auth.php';

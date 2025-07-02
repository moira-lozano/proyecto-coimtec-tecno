<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Página de bienvenida
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard general
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil del usuario autenticado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// En routes/web.php
Route::middleware('web')->group(function () {
    // Rutas de autenticación
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Rutas protegidas por permiso para CLIENTES
Route::middleware(['auth', 'permission:gestionar clientes'])->group(function () {
    Route::controller(ClienteController::class)->prefix('clientes')->name('clientes.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{cliente}', 'show')->name('show');
        Route::get('/{cliente}/edit', 'edit')->name('edit');
        Route::put('/{cliente}', 'update')->name('update');
        Route::delete('/{cliente}', 'destroy')->name('destroy');
    });
});

// Rutas protegidas para USUARIOS
Route::middleware(['auth'])->group(function () {
    Route::controller(UsuarioController::class)->prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{usuario}', 'show')->name('show');
        Route::get('/{usuario}/edit', 'edit')->name('edit');
        Route::post('/{usuario}', 'update')->name('update');
        Route::delete('/{usuario}', 'destroy')->name('destroy');
    });

    // Dashboard según el rol
    Route::get('/usuario/dashboard', [UsuarioController::class, 'dashboard'])->name('usuario.dashboard');
    Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->name('cliente.dashboard');
});

// Registro
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

// Login y autenticación
require __DIR__.'/auth.php';


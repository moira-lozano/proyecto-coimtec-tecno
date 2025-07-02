<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LicenciaController;
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

/////PERMISOS PARA MARCAS ///////
Route::middleware(['auth'])->group(function () {
    Route::get('/marcas', [MarcaController::class, 'index'])
        ->middleware('permission:ver marcas')->name('marcas.index');

    Route::get('/marcas/create', [MarcaController::class, 'create'])
        ->middleware('permission:crear marcas')->name('marcas.create');

    Route::post('/marcas', [MarcaController::class, 'store'])
        ->middleware('permission:crear marcas')->name('marcas.store');

    Route::get('/marcas/{marca}', [MarcaController::class, 'show'])
        ->middleware('permission:ver marcas')->name('marcas.show');

    Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])
        ->middleware('permission:editar marcas')->name('marcas.edit');

    Route::put('/marcas/{marca}', [MarcaController::class, 'update'])
        ->middleware('permission:editar marcas')->name('marcas.update');

    Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy'])
        ->middleware('permission:eliminar marcas')->name('marcas.destroy');
});

//////PERMISOS PARA CATEGORIAS ///////
Route::middleware(['auth'])->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index'])
        ->middleware('permission:ver categorias')->name('categorias.index');

    Route::get('/categorias/create', [CategoriaController::class, 'create'])
        ->middleware('permission:crear categorias')->name('categorias.create');

    Route::post('/categorias', [CategoriaController::class, 'store'])
        ->middleware('permission:crear categorias')->name('categorias.store');

    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])
        ->middleware('permission:ver categorias')->name('categorias.show');

    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])
        ->middleware('permission:editar categorias')->name('categorias.edit');

    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])
        ->middleware('permission:editar categorias')->name('categorias.update');

    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])
        ->middleware('permission:eliminar categorias')->name('categorias.destroy');
});

//////PERMISOS PARA LICENCIAS ///////
Route::middleware(['auth'])->group(function () {
    Route::get('/licencias', [LicenciaController::class, 'index'])
        ->middleware('permission:ver licencias')->name('licencias.index');

    Route::get('/licencias/create', [LicenciaController::class, 'create'])
        ->middleware('permission:crear licencias')->name('licencias.create');

    Route::post('/licencias', [LicenciaController::class, 'store'])
        ->middleware('permission:crear licencias')->name('licencias.store');

    Route::get('/licencias/{licencia}', [LicenciaController::class, 'show'])
        ->middleware('permission:ver licencias')->name('licencias.show');

    Route::get('/licencias/{licencia}/edit', [LicenciaController::class, 'edit'])
        ->middleware('permission:editar licencias')->name('licencias.edit');

    Route::put('/licencias/{licencia}', [LicenciaController::class, 'update'])
        ->middleware('permission:editar licencias')->name('licencias.update');

    Route::delete('/licencias/{licencia}', [LicenciaController::class, 'destroy'])
        ->middleware('permission:eliminar licencias')->name('licencias.destroy');
});


// Login y autenticación
require __DIR__.'/auth.php';


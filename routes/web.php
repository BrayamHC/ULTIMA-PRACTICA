<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ListaClienteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Ruta para la página 'hola'
Route::get('/hola', function () {
    return view('hola');
})->middleware('auth')->name('hola');

// Ruta para el dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Ruta para el formulario de registro (GET)
Route::get('/register', function () {
    return view('register');
})->name('register');

// Rutas de inicio de sesión
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para crear el usuario (POST)
Route::post('/createusuario', [RegisterController::class, 'createUsuario'])->name('createusuario');

// Ruta para la lista de usuarios
Route::get('/usuarios', [DashboardController::class, 'index'])->middleware('auth')->name('usuarios');

// Rutas de clientes
Route::get('/clientes', [ListaClienteController::class, 'index'])->middleware('auth')->name('clientes');

// Rutas de subida de imágenes
// Ruta para mostrar el formulario de búsqueda
Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');

// Ruta para manejar la búsqueda del usuario y redirigir a los detalles
Route::get('profile/search', [ProfileController::class, 'search'])->name('profile.search');

// Ruta para mostrar los detalles del usuario seleccionado
Route::get('profile/detail/{id}', [ProfileController::class, 'showDetail'])->name('profile.showDetail');

// Ruta para actualizar la imagen del usuario
Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

// Ruta para actualizar el correo electrónico
Route::post('/usuarios/{id}/update_email', [RegisterController::class, 'upMusuario'])->name('update_email');

// Ruta para actualizar el nombre
Route::post('/usuarios/{id}/update_name', [RegisterController::class, 'upNusuario'])->name('update_name');
// Ruta para eliminar usuario
Route::delete('/usuarios/{id}', [RegisterController::class, 'deleteUsuario'])->name('usuarios.destroy');

Route::get('/profile/detail', [ProfileController::class, 'showDetail'])->name('profile.detail');

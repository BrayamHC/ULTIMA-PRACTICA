<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\User; // Asegúrate de incluir el modelo correcto
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard con la lista de usuarios registrados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Recuperar todos los usuarios
        $usuarios = User::all(); // Obtener todos los usuarios desde la tabla

        // Pasar los usuarios a la vista
        return view('usuarios', compact('usuarios'));
    }
}

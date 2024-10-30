<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        // Cargar usuarios con sus relaciones de imagen de perfil y thumbnails
        $usuarios = User::all(); // Se obtienen todos los usuarios

        // Pasar los usuarios a la vista
        return view('usuarios', compact('usuarios'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;  // Asegúrate de que el modelo Cliente esté correctamente importado

class ListaClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes
        return view('lista-clientes', compact('clientes')); // Pasar los datos a la vista
    }
}
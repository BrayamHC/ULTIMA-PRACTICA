<?php
// app/Http/Controllers/RegisterController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Usar el modelo User
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function createUsuario(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios_sistema',
            'password' => 'required|string|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Crear el usuario
        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado con éxito. Puedes iniciar sesión.');
    }

    // Método para actualizar el correo electrónico del usuario
    public function upMusuario(Request $request, $id)
    {
        // Validar el correo electrónico
        $request->validate([
            'email' => 'required|email|max:255|unique:usuarios_sistema,email,' . $id, // Excluye el correo actual
        ]);

        // Encontrar al usuario por ID
        $user = User::findOrFail($id); // Cambiado a User
        
        // Actualizar el correo
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Correo actualizado con éxito.');
    }

    // Método para actualizar el nombre del usuario
    public function upNusuario(Request $request, $id)
    {
        // Validar el nombre
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Encontrar al usuario por ID
        $user = User::findOrFail($id); // Cambiado a User
        
        // Actualizar el nombre
        $user->nombre = $request->nombre;
        $user->save();

        return redirect()->back()->with('success', 'Nombre actualizado con éxito.');
    }

    // Método para eliminar un usuario
    public function deleteUsuario(Request $request, $id)
    {
        // Obtiene la variable de entorno URL_SALT del archivo .env
        $urlSalt = env('URL_SALT');
    
        // Genera el hash para comparar
        $hash = substr(hash('sha256', $urlSalt . $id), 0, 8);
    
        // Verifica que el hash enviado en la solicitud coincida
        if ($request->query('hash') !== $hash) {
            return redirect()->back()->with('error', 'Acceso no autorizado: el hash no coincide.');
        }
    
        // Encontrar al usuario por ID
        $user = User::find($id);
    
        // Verifica si el usuario existe
        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }
    
        // Elimina el usuario
        $user->delete();
    
        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect()->route('usuarios')->with('success', 'Usuario eliminado con éxito.');
    }

}

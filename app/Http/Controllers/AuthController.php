<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Asegúrate de que este es el modelo correcto
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Muestra la vista de login
    }

    public function login(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Intentar obtener el usuario por correo
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // Verificar si la contraseña es correcta
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Has iniciado sesión con éxito');
        } else {
            return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
        }
    }

    return back()->withErrors(['email' => 'El usuario no existe.']);
}
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Sesión cerrada.');
    }
}

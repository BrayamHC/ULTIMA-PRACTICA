{{-- resources/views/register.blade.php --}}

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
       body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Altura completa de la ventana */
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, red, blue, white); /* Fondo degradado de rojo a azul y blanco */
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semitransparente */
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            width: 80%;
            max-width: 500px; /* Tamaño máximo ajustado */
        }
        h2 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            background-color: #f8d7da; /* Color de fondo para errores */
            color: #721c24; /* Color del texto para errores */
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #3498db; /* Color del botón */
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s; /* Transición para el efecto hover */
        }
        .btn:hover {
            background-color: #2980b9; /* Color del botón al pasar el mouse */
        }
        .link {
            text-align: center;
            margin-top: 10px;
        }
        .link a {
            color: #3498db; /* Color del enlace */
            text-decoration: none;
        }
        .link a:hover {
            text-decoration: underline; /* Subrayar el enlace al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('createusuario') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control">
            </div>
            <button type="submit" class="btn">Registrar</button>
        </form>

        <div class="link">
            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
        </div>
    </div>
</body>
</html>

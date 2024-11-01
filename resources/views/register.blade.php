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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Tipografía moderna */
            background: linear-gradient(45deg, #2193b0, #6dd5ed); /* Fondo degradado azul */
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95); /* Fondo blanco semitransparente */
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Sombra suave */
            border-radius: 20px;
            width: 80%;
            max-width: 500px; /* Tamaño máximo ajustado */
            opacity: 0; /* Comienza oculto */
            transform: translateY(20px); /* Comienza desplazado hacia abajo */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Transición suave */
        }
        h2 {
            text-align: center;
            color: #333; /* Color de texto más oscuro */
            margin-bottom: 20px;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .alert-danger {
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
            margin-bottom: 10px;
            transition: all 0.3s ease; /* Transición para el efecto hover */
        }
        .btn:hover {
            background-color: #2980b9; /* Color del botón al pasar el mouse */
            transform: translateY(-2px); /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra al hacer hover */
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
    <div class="container" id="register-container">
        <h2>Registro de Usuario</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
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

    <script>
        // Espera a que el DOM esté completamente cargado
        window.onload = function() {
            // Selecciona el contenedor
            var container = document.getElementById('register-container');
            // Cambia la opacidad y la posición del contenedor
            container.style.opacity = '1'; // Hacerlo visible
            container.style.transform = 'translateY(0)'; // Volver a la posición original
        };
    </script>
</body>
</html>

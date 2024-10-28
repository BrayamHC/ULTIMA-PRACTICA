<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco con opacidad */
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            width: 80%;
            max-width: 500px;
        }
        h1 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
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
        }
        .btn:hover {
            background-color: #2980b9; /* Color del botón al pasar el mouse */
        }
        .btn-register {
            background-color: #2ecc71; /* Color del botón de registro */
        }
        .btn-register:hover {
            background-color: #27ae60; /* Color del botón de registro al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>

        <a href="{{ route('register') }}">
            <button class="btn btn-register">Registrar</button>
        </a>
    </div>
</body>
</html>

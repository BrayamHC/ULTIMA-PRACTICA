<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            text-align: center;
            background: rgba(255, 255, 255, 0.9); /* Fondo blanco semitransparente */
            padding: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 30px;
            width: 80%;
            max-width: 600px;
        }
        h1, p {
            color: #000; /* Texto en negro */
        }
        h1 {
            font-size: 36px;
        }
        .dashboard-info {
            margin: 20px 0;
        }
        .nav-buttons {
            margin-top: 20px;
            display: flex; /* Usar flexbox para centrar los botones */
            justify-content: center; /* Centrar horizontalmente */
            gap: 10px; /* Espacio entre botones */
        }
        button {
            background-color: #3498db; /* Color azul */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 5px; /* Espaciado entre botones */
        }
        button:hover {
            background-color: #2980b9; /* Color azul oscuro */
        }
    </style>
</head>
<body>
    <div class="container" id="dashboard-container"> <!-- Asignación de id al contenedor principal -->
        <h1 id="dashboard-title">Bienvenido al Dashboard</h1> <!-- Asignación de id al título -->
        <p class="dashboard-info" id="dashboard-info-text">Esta es la información principal del sistema.</p> <!-- Asignación de id al párrafo -->
        <img id="dashboard-image" src="{{ asset('images/gizmo.png') }}" alt="Descripción de la imagen" style="max-width: 100%; height: auto;"> <!-- Asignación de id a la imagen -->
        <div class="nav-buttons" id="navigation-buttons"> <!-- Asignación de id al contenedor de botones de navegación -->
            <a href="{{ route('clientes') }}">
                <button id="clientes-button">Lista de Clientes</button> <!-- Asignación de id al botón de clientes -->
            </a>
            <a href="{{ route('hola') }}">
                <button id="hola-button">Ir a Hola</button> <!-- Asignación de id al botón de Hola -->
            </a>
            <a href="{{ route('usuarios') }}">
                <button id="usuarios-button">Lista de Usuarios</button> <!-- Asignación de id al botón de usuarios -->
            </a>
        </div>

        <form action="{{ route('logout') }}" method="POST" id="logout-form"> <!-- Asignación de id al formulario de logout -->
            @csrf
            <button type="submit" id="logout-button">Cerrar sesión</button> <!-- Asignación de id al botón de logout -->
        </form>
    </div>
</body>
</html>

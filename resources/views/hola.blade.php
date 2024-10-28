<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola Mundo</title>
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
            border-radius: 10px;
        }
        h1, p {
            color: #000; /* Texto en negro */
        }
        h1 {
            font-size: 48px;
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
            margin-top: 20px; /* Espaciado superior para el botón */
        }
        button:hover {
            background-color: #2980b9; /* Color azul oscuro */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Hola Mundo!</h1>
        <p>Mi nombre es Brayam Herrera.</p>
        
        <!-- Botón para regresar al dashboard -->
        <a href="{{ route('dashboard') }}">
            <button>Regresar al Dashboard</button>
        </a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCESO DENEGADO</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            max-width: 600px;
            width: 80%; /* Ancho responsivo */
            background: rgba(255, 255, 255, 0.9); /* Fondo blanco con opacidad */
            padding: 40px; /* Espaciado interno */
            border-radius: 40px; /* Bordes redondeados */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra de la tarjeta */
        }
        h1 {
            text-align: center; /* Centrando el título principal */
            color: black; /* Color del título */
        }
        p {
            color: red; /* Color para mensajes de error */
            text-align: center; /* Centrando mensaje de error */
        }
        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            border-top: 1px solid #ddd; /* Línea divisoria para separar secciones */
            padding-top: 20px; /* Espaciado en la parte superior */
        }
        input[type="text"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            background-color: #007bff; /* Color del botón */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3; /* Color del botón al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>URL Inválida</h1>

        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif

    
    </div>
</body>
</html>

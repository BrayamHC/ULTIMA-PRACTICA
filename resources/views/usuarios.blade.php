<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
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
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Usuarios Registrados</h1>

        <!-- Tabla que muestra los usuarios registrados -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="nav-buttons">
            <a href="{{ route('dashboard') }}">
                <button>Regresar al Dashboard</button>
            </a>
        </div>
    </div>
</body>
</html>

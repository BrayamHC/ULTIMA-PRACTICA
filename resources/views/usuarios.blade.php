<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            height: auto;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, red, blue, white);
        }
        .container {
            width: 80%;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #fff; /* Color blanco para los títulos */
            margin-bottom: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .search-bar input {
            padding: 8px; /* Reducido el padding para hacerlo más pequeño */
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            width: 60%; /* Ancho del input reducido */
        }
        .search-bar button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px; /* Reducido el tamaño del botón */
            font-size: 14px; /* Tamaño de fuente reducido */
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search-bar button:hover {
            background-color: #2980b9;
        }
        .user-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            border-radius: 10px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 20px 5px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .edit-button {
            background-color: #2ecc71;
        }
        .edit-button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Búsqueda de Usuario</h1>

        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif

        <!-- Barra de búsqueda para buscar usuarios por nombre -->
        <form action="{{ route('profile.search') }}" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Ingresa el nombre del usuario..." required>
            <button type="submit">Buscar</button>
        </form>

        <h1>Lista de Usuarios Registrados</h1>

        <!-- Tarjeta para mostrar la información de los usuarios -->
        <div class="user-card">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Imagen de Perfil</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                @if($usuario->url_imagen)
                                    <img src="{{ asset('storage/' . $usuario->url_imagen) }}" alt="Imagen de Perfil">
                                @else
                                    No disponible
                                @endif
                            </td>
                            <td>
                                <!-- Botón de edición con la ruta hacia el perfil de edición del usuario -->
                                <a href="{{ route('profile.showDetail', ['id' => $usuario->id]) }}">
                                    <button class="edit-button">Editar</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <a href="{{ route('dashboard') }}">
                <button>Regresar al Dashboard</button>
            </a>
        </div>
    </div>
</body>
</html>

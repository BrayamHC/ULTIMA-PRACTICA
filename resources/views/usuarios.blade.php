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
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #2193b0; /* Degradado azul */
            opacity: 0; /* Inicialmente oculto */
            transition: opacity 0.5s ease; /* Transición de opacidad */
        }
        body.visible {
            opacity: 1; /* Cuando se aplica la clase visible, muestra el contenido */
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95); /* Fondo blanco semitransparente */
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Sombra suave */
            border-radius: 20px;
            width: 90%;
            max-width: 800px;
        }
        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .search-bar input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            width: 70%;
        }
        .search-bar button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search-bar button:hover {
            background-color: #2980b9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #555;
        }
        .user-card {
            margin-top: 20px;
        }
        img {
            max-width: 80px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .nav-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

        <!-- Tabla para mostrar la información de los usuarios -->
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
                                <a href="{{ route('profile.idhash', ['id' => $usuario->id]) }}?idsello={{ substr(hash('sha256', env('URL_SALT') . $usuario->id), 0, 8) }}">
                                    <button class="edit-button">Editar</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="nav-buttons">
            <a href="{{ route('dashboard') }}">
                <button>Regresar al Dashboard</button>
            </a>
        </div>
    </div>

    <script>
        // Función para manejar el desvanecimiento al cargar la página
        window.onload = function() {
            document.body.classList.add('visible'); // Cambiar la clase para mostrar el contenido
        };

        const links = document.querySelectorAll('.nav-buttons a'); // Selecciona los enlaces en el contenedor de navegación

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault(); // Prevenir el comportamiento por defecto del enlace
                document.body.classList.remove('visible'); // Cambiar la clase para desvanecer

                // Esperar a que la animación termine antes de redirigir
                setTimeout(() => {
                    window.location.href = this.href; // Redirigir a la nueva página
                }, 500); // Tiempo que coincide con la duración de la animación
            });
        });
    </script>
</body>
</html>

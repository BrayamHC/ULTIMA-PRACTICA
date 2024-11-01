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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Tipografía moderna */
            background: #2193b0; /* Degradado azul */
            transition: opacity 0.5s ease; /* Transición para el desvanecimiento */
            opacity: 0; /* Inicialmente oculto */
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95); /* Fondo blanco semitransparente */
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Sombra suave */
            border-radius: 20px;
            width: 90%;
            max-width: 600px;
        }
        h1 {
            color: #333; /* Color de texto más oscuro */
            font-size: 32px;
            margin-bottom: 10px;
        }
        p {
            color: #555; /* Color de texto gris */
            margin-bottom: 20px;
        }
        .dashboard-info {
            margin: 20px 0;
            font-size: 16px;
            line-height: 1.5;
        }
        img {
            border-radius: 10px; /* Esquinas redondeadas para la imagen */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra suave en la imagen */
            margin-bottom: 20px;
        }
        .nav-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px; /* Espacio entre botones */
        }
        button {
            background-color: #3498db; /* Color azul */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover {
            background-color: #2980b9; /* Azul más oscuro al pasar el ratón */
            transform: translateY(-2px); /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra al hacer hover */
        }
        form {
            margin-top: 20px;
        }
        #logout-button {
            background-color: #e74c3c; /* Color rojo para el botón de cerrar sesión */
        }
        #logout-button:hover {
            background-color: #c0392b; /* Rojo más oscuro al hacer hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido al Dashboard</h1>
        <p class="dashboard-info">Esta es la información principal del sistema.</p>
        <img src="{{ asset('images/gizmo.png') }}" alt="Descripción de la imagen" style="max-width: 100%; height: auto;">
        <div class="nav-buttons">
            <a href="{{ route('clientes') }}" class="nav-link">
                <button>Lista de Clientes</button>
            </a>
            <a href="{{ route('hola') }}" class="nav-link">
                <button>Ir a Hola</button>
            </a>
            <a href="{{ route('usuarios') }}" class="nav-link">
                <button>Lista de Usuarios</button>
            </a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" id="logout-button">Cerrar sesión</button>
        </form>
    </div>

    <script>
        // Función para manejar el desvanecimiento al cargar la página
        window.onload = function() {
            document.body.style.opacity = 1; // Cambiar la opacidad a 1 al cargar
        };

        const links = document.querySelectorAll('.nav-link');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault(); // Prevenir el comportamiento por defecto del enlace
                document.body.style.opacity = 0; // Cambiar la opacidad a 0 para desvanecer

                // Esperar a que la animación termine antes de redirigir
                setTimeout(() => {
                    window.location.href = this.href; // Redirigir a la nueva página
                }, 500); // Tiempo que coincide con la duración de la animación
            });
        });
    </script>
</body>
</html>

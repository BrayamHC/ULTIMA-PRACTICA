<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Altura completa de la ventana */
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Tipografía moderna */
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
            width: 80%; /* Ancho ajustado */
            max-width: 800px; /* Ancho máximo */
        }
        h1 {
            color: #333; /* Color de texto más oscuro */
            margin-bottom: 20px;
            font-size: 36px; /* Tamaño de fuente para el título */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd; /* Bordes más suaves */
        }
        th, td {
            padding: 12px; /* Mayor espaciado en celdas */
            text-align: center;
        }
        th {
            background-color: #f4f4f9; /* Color de fondo de los encabezados */
            color: #333; /* Color del texto de los encabezados */
        }
        button {
            background-color: #3498db; /* Color azul */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease; /* Transición para todos los cambios */
            margin-top: 20px; /* Espaciado superior para el botón */
        }
        button:hover {
            background-color: #2980b9; /* Color azul oscuro */
            transform: translateY(-2px); /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra al hacer hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Clientes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->Nombre }}</td>
                        <td>{{ $cliente->APaterno }}</td>
                        <td>{{ $cliente->AMaterno }}</td>
                        <td>{{ $cliente->Telefono }}</td>
                        <td>{{ $cliente->Correo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Botón para regresar al dashboard -->
        <a href="{{ route('dashboard') }}">
            <button>Regresar al Dashboard</button>
        </a>
    </div>

    <script>
        // Función para manejar el desvanecimiento al cargar la página
        window.onload = function() {
            document.body.classList.add('visible'); // Cambiar la clase para mostrar el contenido
        };

        const link = document.querySelector('.container a'); // Selecciona el enlace en el contenedor

        link.addEventListener('click', function (e) {
            e.preventDefault(); // Prevenir el comportamiento por defecto del enlace
            document.body.classList.remove('visible'); // Cambiar la clase para desvanecer

            // Esperar a que la animación termine antes de redirigir
            setTimeout(() => {
                window.location.href = this.href; // Redirigir a la nueva página
            }, 500); // Tiempo que coincide con la duración de la animación
        });
    </script>
</body>
</html>

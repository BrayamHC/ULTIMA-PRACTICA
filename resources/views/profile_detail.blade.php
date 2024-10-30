<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metadatos básicos de la página -->
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura el viewport para diseño responsivo -->
    <title>Detalles de Usuario</title> <!-- Título de la página -->

    <!-- Vincula el archivo de estilos CSS de Laravel -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Estilos internos para la apariencia de la página -->
    <style>
        /* Estilos para el cuerpo de la página */
        body {
            display: flex; /* Usa flexbox para centrar el contenido en la pantalla */
            justify-content: center; /* Centra el contenido horizontalmente */
            align-items: center; /* Centra el contenido verticalmente */
            height: 100vh; /* Altura completa de la ventana */
            margin: 0; /* Elimina el margen predeterminado */
            font-family: Arial, sans-serif; /* Define la fuente de texto */
            background: linear-gradient(to bottom, red, blue, white); /* Fondo degradado de rojo a azul y blanco */
        }

        /* Estilos para el contenedor principal */
        .container {
            max-width: 600px; /* Ancho máximo del contenedor */
            background: white; /* Fondo blanco */
            padding: 30px; /* Espaciado interno */
            border-radius: 20px; /* Bordes redondeados */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra sutil alrededor del contenedor */
            text-align: center; /* Centra el texto dentro del contenedor */
        }

        /* Estilo para el título principal */
        h1 {
            color: #007bff; /* Color azul para el título principal */
        }

        /* Estilo para el subtítulo */
        h2 {
            color: #333; /* Color gris oscuro */
            margin: 15px 0 10px 0; /* Espaciado superior e inferior */
        }

        /* Estilos para la imagen de perfil */
        img {
            border-radius: 50%; /* Hace la imagen circular */
            margin-bottom: 20px; /* Espaciado inferior */
            width: 150px; /* Ancho fijo de la imagen */
            height: 150px; /* Alto fijo de la imagen */
            object-fit: cover; /* Ajusta la imagen para que cubra completamente el contenedor */
        }

        /* Estilos para mostrar datos de usuario en fila */
        .user-data {
            display: flex; /* Usa flexbox para alinear elementos en fila */
            align-items: center; /* Centra verticalmente los elementos */
            gap: 20px; /* Espaciado entre elementos */
            margin: 20px 0; /* Espaciado superior e inferior */
        }

        /* Estilos para el formulario */
        form {
            margin-top: 20px; /* Espaciado superior */
            display: flex; /* Usa flexbox para organizar el formulario */
            flex-direction: column; /* Coloca los elementos en columna */
            gap: 10px; /* Espaciado entre los elementos del formulario */
        }

        /* Estilos para los botones */
        button {
            padding: 10px; /* Espaciado interno */
            background-color: #007bff; /* Color de fondo azul */
            color: white; /* Color del texto en blanco */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cambia el cursor al pasar el mouse */
            transition: background-color 0.3s; /* Transición suave para el cambio de color */
            margin-top: 15px; /* Espaciado superior adicional */
        }

        /* Estilo para el botón al pasar el mouse */
        button:hover {
            background-color: #0056b3; /* Color de fondo más oscuro al pasar el mouse */
        }

        /* Estilos para el botón de eliminar */
        .delete-button {
            background-color: #dc3545; /* Color de fondo rojo para el botón de eliminar */
        }

        /* Estilo para el botón de eliminar al pasar el mouse */
        .delete-button:hover {
            background-color: #c82333; /* Color de fondo más oscuro para el botón de eliminar al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Contenedor principal -->
        <h1>Detalles de Usuario</h1> <!-- Título principal -->

        <!-- Subtítulo que muestra el nombre del usuario -->
        <h2>Perfil de {{ $user->nombre }}</h2> 

        <div class="user-data"> <!-- Contenedor para mostrar datos de usuario -->
            <p><strong>Email:</strong> {{ $user->email }}</p> <!-- Muestra el correo electrónico del usuario -->

            <!-- Verifica si el usuario tiene una imagen de perfil existente -->
            @if ($user->url_imagen && Storage::disk('public')->exists($user->url_imagen))
                <h3>Imagen de perfil:</h3> <!-- Subtítulo para la imagen de perfil -->
                <img src="{{ asset('storage/' . $user->url_imagen) }}" alt="Imagen de perfil"> <!-- Muestra la imagen de perfil -->
            @else
                <p>No tiene imagen de perfil. Por favor, sube una imagen:</p> <!-- Mensaje si no hay imagen de perfil -->
            @endif
        </div>

        <!-- Formulario para subir una nueva imagen de perfil -->
        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Protección contra CSRF -->
            <label for="image">Sube tu imagen:</label> <!-- Etiqueta para el campo de imagen -->
            <input type="file" name="image" id="image" accept="image/jpeg,image/png" required> <!-- Campo de entrada para la imagen -->
            @error('image')
                <span class="alert-error">{{ $message }}</span> <!-- Muestra mensaje de error si hay problemas con la imagen -->
            @enderror
            <button type="submit">Actualizar imagen</button> <!-- Botón para enviar el formulario -->
        </form>

        <!-- Formulario para actualizar el nombre del usuario -->
        <form action="{{ route('update_name', ['id' => $user->id]) }}" method="POST" class="input-field">
            @csrf <!-- Protección CSRF -->
            <input type="text" name="nombre" id="nombre" placeholder="Nuevo Nombre" required> <!-- Campo de entrada para el nuevo nombre -->
            <button type="submit">Actualizar Nombre</button> <!-- Botón para enviar el formulario -->
        </form>

        <!-- Formulario para actualizar el correo electrónico del usuario -->
        <form action="{{ route('update_email', ['id' => $user->id]) }}" method="POST" class="input-field">
            @csrf <!-- Protección CSRF -->
            <input type="email" name="email" id="email" placeholder="Nuevo Correo" required> <!-- Campo de entrada para el nuevo correo -->
            <button type="submit">Actualizar Email</button> <!-- Botón para enviar el formulario -->
        </form>

        <!-- Botón para eliminar al usuario -->
        <form action="{{ route('usuarios.destroy', ['id' => $user->id]) }}" method="POST" style="display:inline;">
            @csrf <!-- Protección contra CSRF -->
            @method('DELETE') <!-- Método para simular una solicitud DELETE -->
            <button type="submit" class="delete-button">Eliminar Usuario</button>
        </form>
        <!-- Formulario para regresar a la vista anterior -->
        <form action="{{ route('usuarios') }}" method="GET">
            <button type="submit" class="back-button">Regresar</button> <!-- Botón de regreso -->
        </form>
    </div>
</body>
</html>

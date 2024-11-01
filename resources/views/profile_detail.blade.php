<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Usuario</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Alinear al inicio */
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background:  #2193b0;
            padding: 20px; /* Espaciado para pantallas pequeñas */
            opacity: 0; /* Inicialmente oculto */
            transition: opacity 0.5s ease-in-out; /* Transición suave de opacidad */
        }

        body.show {
            opacity: 1; /* Muestra el cuerpo cuando se agrega la clase 'show' */
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 20px; /* Espaciado para el contenedor */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Atenuar la sombra */
            border-radius: 5px; /* Atenuar los bordes */
            width: 100%; /* Ancho completo */
            max-width: 1000px;
            overflow: hidden; /* Evitar desbordamientos */
            margin-top: 10px; /* Reducir margen superior para alinearlo con el navegador */
        }

        h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 10px;
        }

        h2 {
            color: #555;
            margin: 10px 0; /* Reducir margen */
        }

        p {
            color: #555;
            margin-bottom: 10px; /* Reducir margen */
        }

        img {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px; /* Reducir margen */
            max-width: 100%;
            height: auto;
        }

        .user-data {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px; /* Espaciado entre los datos de usuario */
        }

        form {
            margin-top: 10px; /* Reducir margen superior en los formularios */
        }

        input[type="file"], input[type="text"], input[type="email"] {
            width: 100%;
            max-width: 300px;
            padding: 8px; /* Reducir padding */
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px; /* Reducir margen superior */
        }

        .nav-buttons {
            margin-top: 10px; /* Reducir margen superior */
            display: flex;
            justify-content: center;
            gap: 10px; /* Reducir espacio entre botones */
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 16px; /* Reducir padding */
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
            transform: translateY(-1px); /* Ajustar desplazamiento en hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .delete-button {
            background-color: #e74c3c;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        .back-button {
            background-color: #95a5a6;
        }

        .back-button:hover {
            background-color: #7f8c8d;
        }

        .thumbnails-container {
            display: flex;
            justify-content: center;
            gap: 10px; /* Reducir espacio entre thumbnails */
            flex-wrap: wrap; /* Permitir que los thumbnails se ajusten en varias líneas */
            margin-bottom: 10px; /* Reducir margen inferior */
        }

        .thumbnail {
            text-align: center;
        }

        .horizontal-layout {
            display: flex;
            justify-content: space-around;
            align-items: flex-start; /* Alineación superior */
            flex-wrap: wrap; /* Permitir que el contenido se ajuste en varias líneas */
            margin-bottom: 10px; /* Reducir margen inferior */
        }
    </style>
</head>
<body onload="fadeIn()">
    <div class="container">
        <h1>Detalles de Usuario</h1>
        <h2>Perfil de {{ $user->nombre }}</h2>

        <div class="horizontal-layout">
            <div class="user-data">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                @if ($user->url_imagen && Storage::disk('public')->exists($user->url_imagen))
                    <h3>Imagen de perfil:</h3>
                    <img src="{{ asset('storage/' . $user->url_imagen) }}" alt="Imagen de perfil">
                @else
                    <p>No tiene imagen de perfil. Por favor, sube una imagen:</p>
                @endif
            </div>

            <div class="thumbnails-container">
                <h3>Thumbnails:</h3>
                @foreach (['100x100', '300x200', '400x400'] as $size)
                    @php
                        $thumbnailPath = 'uploads/' . basename($user->url_imagen, '.jpg') . '_' . $size . '.jpg';
                    @endphp
                    <div class="thumbnail">
                        @if (Storage::disk('public')->exists($thumbnailPath))
                            <img src="{{ asset('storage/' . $thumbnailPath) }}" alt="Thumbnail {{ $size }}" style="width: {{ str_replace('x', 'px', $size) }};">
                            <p>{{ $size }}</p>
                        @else
                            <p>No hay thumbnail para {{ $size }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" id="image" accept="image/jpeg,image/png" required>
            <button type="submit">Actualizar Imagen</button>
        </form>

        <form action="{{ route('update_name', ['id' => $user->id]) }}" method="POST">
            @csrf
            <input type="text" name="nombre" id="nombre" placeholder="Nuevo Nombre" required>
            <button type="submit">Actualizar Nombre</button>
        </form>

        <form action="{{ route('update_email', ['id' => $user->id]) }}" method="POST">
            @csrf
            <input type="email" name="email" id="email" placeholder="Nuevo Correo" required>
            <button type="submit">Actualizar Email</button>
        </form>

        <form action="{{ route('usuarios.destroy', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-button">Eliminar Usuario</button>
        </form>

        <div class="nav-buttons">
            <a href="{{ route('usuarios') }}">
                <button class="back-button">Regresar</button>
            </a>
        </div>
    </div>

    <script>
        function fadeIn() {
            document.body.classList.add('show');
        }
    </script>
</body>
</html>

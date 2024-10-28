<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Usuario</title>
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
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        h2, h3 {
            color: #333;
            margin: 15px 0 5px 0;
        }
        img {
            border-radius: 10px;
            margin-bottom: 10px;
            display: block;
            max-width: 100%;
            height: auto;
        }
        .thumbnail {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
        }
        .thumbnails-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-button {
            margin-top: 15px;
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles de Usuario</h1>

        @if (session('success'))
            <p class="alert-success">{{ session('success') }}</p>
        @endif

        <h2>Perfil de {{ $user->nombre }}</h2>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        @if ($user->url_imagen && Storage::disk('public')->exists($user->url_imagen))
            <h3>Imagen de perfil:</h3>
            <img src="{{ asset('storage/' . $user->url_imagen) }}" alt="Imagen de perfil">
        @else
            <p>No tiene imagen de perfil. Por favor, sube una imagen:</p>
        @endif

        <h3>Thumbnails:</h3>
        <div class="thumbnails-container">
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

        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="image">Sube tu imagen:</label>
            <input type="file" name="image" id="image" accept="image/jpeg,image/png" required>
            @error('image')
                <span class="alert-error">{{ $message }}</span>
            @enderror
            <button type="submit">Actualizar imagen</button>
        </form>

        <!-- Botón de regreso -->
        <form action="{{ route('profile.show') }}" method="GET">
            <button type="submit" class="back-button">Regresar</button>
        </form>
    </div>
</body>
</html>

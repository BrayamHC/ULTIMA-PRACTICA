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
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, red, blue, white); /* Fondo degradado de rojo a azul y blanco */
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.9); /* Fondo blanco semitransparente */
            padding: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 30px;
            width: 80%; /* Ancho ajustado */
            max-width: 1000px; /* Ancho máximo */
        }
        h1 {
            color: #000; /* Texto en negro */
            margin-bottom: 20px;
            font-size: 48px; /* Tamaño de fuente para el título */
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
</body>
</html>
